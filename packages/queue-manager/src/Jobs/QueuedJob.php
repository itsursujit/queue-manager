<?php

namespace Sujit\QueueManager\Jobs;

use Carbon\Carbon;

/**
 * Class QueuedJob
 * @package Sujit\QueueManager\Jobs
 */
class QueuedJob
{
    /**
     * @var
     */
    private $id;
    // base64-encoded, serialized version of the command
    /**
     * @var
     */
    private $command;
    // how many tries before failing
    /**
     * @var
     */
    private $attempts;
    /**
     * @var Carbon
     */
    private $created;
    /**
     * @var Carbon
     */
    private $updated;
    /**
     * @var Carbon
     */
    private $completed;

    /**
     *
     */
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * QueuedJob constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param object $command
     * @param int $attempts
     * @return QueuedJob
     */
    public static function fromCommand(object $command, int $attempts = 5): QueuedJob
    {
        $job = new QueuedJob();
        $job->id = null;
        $job->command = base64_encode(serialize($command));
        $job->attempts = $attempts;
        $job->created = now();
        $job->updated = now();
        $job->completed = null;
        return $job;
    }

    /**
     * @param object $data
     * @return QueuedJob
     */
    public static function fromDb(object $data): QueuedJob
    {
        $job = new QueuedJob();
        $job->id = $data->id;
        $job->command = $data->command;
        $job->attempts = $data->attempts;
        $job->created = Carbon::createFromFormat(QueuedJob::DATE_FORMAT, $data->created);
        $job->updated = Carbon::createFromFormat(QueuedJob::DATE_FORMAT, $data->updated);
        $job->completed = $data->completed ? Carbon::createFromFormat(QueuedJob::DATE_FORMAT, $data->completed) : null;
        return $job;
    }

    /**
     * @return array
     */
    public function toDb(): array
    {
        return [
            'command' => $this->command,
            'attempts' => $this->attempts,
            'created' => $this->created,
            'updated' => $this->updated,
            'completed' => $this->completed,
        ];
    }

    // Read -------------------------------------------------------------------

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return object
     * @throws UnserializeError
     */
    public function command(): object
    {
        try {
            return unserialize(base64_decode($this->command));
        } catch (\Throwable $e) {
            throw new UnserializeError("Error unserializing id:" . $this->id() . "\n" . $e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function rawCommand(): string
    {
        return $this->command;
    }

    /**
     * @return int
     */
    public function attempts(): int
    {
        return $this->attempts;
    }

    /**
     * @return bool
     */
    public function failed(): bool
    {
        return $this->attempts === 0;
    }

    /**
     * @return int
     */
    public function processingTime(): int
    {
        if (is_null($this->completed)) {
            return 0;
        }
        return $this->completed->diffInSeconds($this->created);
    }

    /**
     * @return Carbon
     */
    public function created(): Carbon
    {
        return $this->created;
    }

    /**
     * @return Carbon
     */
    public function updated(): Carbon
    {
        return $this->updated;
    }

    /**
     * @return Carbon|null
     */
    public function completed(): ?Carbon
    {
        return $this->completed;
    }

    // Write ------------------------------------------------------------------

    /**
     *
     */
    public function touch(): void
    {
        $this->updated = now();
    }

    /**
     *
     */
    public function setComplete(): void
    {
        $this->completed = now();
    }

    /**
     *
     */
    public function retry(): void
    {
        if (!$this->attempts) {
            $this->attempts++;
        }
    }

    /**
     *
     */
    public function decrementAttempts(): void
    {
        if ($this->attempts > 0) {
            $this->attempts--;
        }
    }
}
