<?php


namespace Sujit\Messenger\Models;


class ThreadMessage extends BaseModel
{
    protected $table = 'messenger_thread_messages';

    protected $fillable = [
        'id',
        'messenger_thread_id',
        'message',
        'status',
        'failed_reason'
    ];
}
