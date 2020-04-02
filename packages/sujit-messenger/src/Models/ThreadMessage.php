<?php


namespace Sujit\Messenger\Models;


class ThreadMessage extends BaseModel
{

    protected $fillable = [
        'id',
        'messenger_thread_id',
        'message',
        'status',
        'failed_reason'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.messenger_thread_messages_table'));
    }
}
