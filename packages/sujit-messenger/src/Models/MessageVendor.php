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

    public function services()
    {
        return $this->belongsToMany(MessageService::class, VendorService::class, 'vendor_id', 'service_id')
            ->withPivot(app(VendorService::class)->getFillable());
    }
}
