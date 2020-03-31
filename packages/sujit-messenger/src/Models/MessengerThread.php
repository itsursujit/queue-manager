<?php


namespace Sujit\Messenger\Models;


class MessengerThread extends BaseModel
{
    protected $table = 'messenger_threads';

    protected $fillable = [
        'id',
        'label',
        'user_id',
        'user_service_id',
        'recipient'
    ];
}
