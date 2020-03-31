<?php


namespace Sujit\Messenger\Models;


class UserService extends BaseModel
{
    protected $table = 'user_services';

    protected $fillable = [
        'id',
        'user_id',
        'vendor_service_id',
        'credentials',
        'has_credentials',
        'service_particular',
        'particular_details'
    ];
}
