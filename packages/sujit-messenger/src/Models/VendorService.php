<?php


namespace Sujit\Messenger\Models;


class VendorService extends BaseModel
{

    protected $fillable = [
        'service',
        'slug',
        'avatar'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.vendor_services_table'));
    }

    public function vendors()
    {
        $this->hasManyThrough(Vendor::class, VendorServiceDetails::class);
    }
}
