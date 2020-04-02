<?php


namespace Sujit\Messenger\Models;


class VendorServiceDetails extends BaseModel
{

    protected $fillable = [
        'id',
        'vendor_id',
        'service_id',
        'auth_url',
        'auth_type',
        'auth_headers',
        'auth_extra_fields',
        'message_sending_url',
        'message_receiving_url',
        'message_sending_headers',
        'message_receiving_headers',
        'notify_url',
        'use_generated_token_for_auth',
        'allow_sending',
        'allow_receiving',
        'allow_optout',
        'allow_emojis',
        'allow_multimedia',
        'has_client_credentials',
        'allow_custom_sender_id',
        'use_as_sender_id',
        'is_admin_managed',
        'is_auto',
        'setup_period',
        'min_subscription_period',
        'available_countries',
        'credentials',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('messenger.tables.vendor_service_details_table'));
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'vendor_id');
    }

    public function service()
    {
        return $this->hasOne(VendorService::class, 'service_id');
    }
}
