<?php


namespace Sujit\Messenger\Models;


class Vendor extends BaseModel
{

    protected $fillable = [
        'name',
        'slug',
        'avatar'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.vendors_table'));
    }

    public function services()
    {
        return $this->belongsToMany(VendorService::class, VendorServiceDetails::class, 'vendor_id', 'service_id')
            ->withPivot(app(VendorServiceDetails::class)->getFillable());
    }
}
