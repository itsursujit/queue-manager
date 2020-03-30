<?php


namespace Sujit\Messenger\Models;


class VendorService extends BaseModel
{

    protected $table = 'vendor_services';

    protected $fillable = [
        'vendor_id',
        'service_id',
        'auth_url',
        'message_sending_url',
        'message_receiving_url',
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
}
