<?php

namespace Sujit\QueueManager\Http\Middlewares;

use Illuminate\Database\Connection;
use Throwable;

class DbTransactionMiddleware implements Middleware
{
    /**
     * @var Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     * @throws Throwable
     */
    public function execute(object $command, callable $next)
    {
        $this->db->beginTransaction();
        try {
            $val = $next($command);
            $this->db->commit();
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $val;
    }
}
