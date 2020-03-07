<?php

namespace Sujit\QueueManager\Services;

class Lock
{
    private $lockfile;

    public const STATUS_EXEC = 'executing';
    public const STATUS_PAUSED = 'paused';

    public function __construct(string $lockfile = null)
    {
        $this->lockfile = is_null($lockfile) ? storage_path('app' . DIRECTORY_SEPARATOR . 'queue-manager.lock') : $lockfile;
    }

    /**
     * Returns true if exclusive lock obtained
     * @param int $timeoutMinutes
     * @return bool
     */
    public function set(int $timeoutMinutes): bool
    {
        if ($this->isLocked()) {
            return false;
        }
        $this->setLock($timeoutMinutes);
        return true;
    }

    public function clear()
    {
        file_put_contents($this->lockfile, '0');
    }

    public function pause(int $timeoutMinutes): bool
    {
        if ($this->isLocked()) {
            return false;
        }
        $this->setLock($timeoutMinutes, true);
        return true;
    }

    public function resume(): bool
    {
        if (!$this->isPaused()) {
            return false;
        }
        $this->clear();
        return true;
    }

    protected function isPaused(): bool
    {
        return $this->status() === static::STATUS_PAUSED;
    }

    // Locked = executing or paused
    protected function isLocked(): bool
    {
        return $this->status() ? true : false;
    }

    /** @return string|false - STATUS_PAUSED, STATUS_EXEC or false */
    protected function status()
    {
        if (!file_exists($this->lockfile)) {
            return false;
        }
        $lockData = file_get_contents($this->lockfile);
        $exploded = explode('|', $lockData);
        $lockTime = intval($exploded[0]);
        // If $lockTime is 0 and $exploded[1] isn't set, then $lockTime will never be > time(), so false is fine here
        $lockType = isset($exploded[1]) ? $exploded[1] : false;
        return $lockTime > time() ? $lockType : false;
    }

    protected function setLock(int $timeoutMinutes, $paused = false)
    {
        $data = strval(time() + ($timeoutMinutes * 60)) . '|';
        $data .= $paused ? static::STATUS_PAUSED : static::STATUS_EXEC;
        file_put_contents($this->lockfile, $data);
    }
}
