<?php


namespace Sujit\Messenger\Models;


class MessengerThread extends BaseModel
{

    protected $fillable = [
        'id',
        'label',
        'user_id',
        'user_service_id',
        'recipient'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.messenger_threads_table'));
    }
}
