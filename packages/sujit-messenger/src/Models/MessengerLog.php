<?php


namespace Sujit\Messenger\Models;


class MessengerLog extends BaseModel
{

    protected $fillable = [
        'user_id',
        'vendor_service_id',
        'request_data',
        'response',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.messenger_logs_table'));
    }
}
