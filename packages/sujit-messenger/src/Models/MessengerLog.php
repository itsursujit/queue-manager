<?php


namespace Sujit\Messenger\Models;


class MessengerLog extends BaseModel
{
    protected $table = 'messenger_logs';

    protected $fillable = [
        'user_id',
        'vendor_service_id',
        'request_data',
        'response',
    ];
}
