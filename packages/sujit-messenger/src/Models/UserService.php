<?php


namespace Sujit\Messenger\Models;


class UserService extends BaseModel
{

    protected $fillable = [
        'id',
        'user_id',
        'vendor_service_id',
        'credentials',
        'has_credentials',
        'service_particular',
        'particular_details'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.user_services_table'));
    }
}
