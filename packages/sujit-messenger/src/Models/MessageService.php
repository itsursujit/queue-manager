<?php


namespace Sujit\Messenger\Models;


class MessageService extends BaseModel
{
    protected $table = 'message_services';

    protected $fillable = [
        'service',
        'slug',
        'avatar'
    ];

    public function vendors()
    {
        $this->hasManyThrough(MessageVendor::class, VendorService::class);
    }
}
