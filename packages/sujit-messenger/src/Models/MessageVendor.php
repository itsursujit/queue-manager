<?php


namespace Sujit\Messenger\Models;


class MessageVendor extends BaseModel
{

    protected $table = 'message_vendors';

    protected $fillable = [
        'name',
        'slug',
        'avatar'
    ];
}
