<?php

namespace Sujit\Messenger\Database\Seeds;

use Illuminate\Database\Seeder;
use Sujit\Messenger\Models\VendorService;
use Sujit\Messenger\Models\Vendor;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $vendors = Vendor::insert([
            ['name' => 'Facebook', 'slug' => 'facebook'],
            ['name' => 'Asterik', 'slug' => 'asterik'],
            ['name' => 'Routee', 'slug' => 'routee'],
            ['name' => 'Whatsapp', 'slug' => 'whatsapp'],
            ['name' => 'Viber', 'slug' => 'viber']
        ]);

        $longcode = VendorService::create([
            'service' => 'Longcode',
            'slug' => 'longcode'
        ]);

        $shortcode = VendorService::create([
            'service' => 'Shortcode',
            'slug' => 'shortcode'
        ]);

        $tollfree = VendorService::create([
            'service' => 'Tollfree',
            'slug' => 'tollfree'
        ]);

        $virtualNumber = VendorService::create([
            'service' => 'Virtual Number',
            'slug' => 'virtual-number'
        ]);

        $facebookService = VendorService::create([
            'service' => 'Facebook',
            'slug' => 'facebook'
        ]);

        $whatsappService = VendorService::create([
            'service' => 'Whatsapp',
            'slug' => 'whatsapp'
        ]);

        $viberService = VendorService::create([
            'service' => 'Viber',
            'slug' => 'viber'
        ]);

        $routee = Vendor::where('slug', 'routee')->first();
        $routee->services()->attach($longcode, [
            'message_sending_url' => 'https://connect.routee.net/sms',
            'auth_url' => 'https://auth.routee.net/oauth/token',
            'auth_type' => 'basic', // basic, apiKey, oauth
            'auth_headers' => json_encode([
                'content-type: application/x-www-form-urlencoded'
            ]),
            'auth_extra_fields' => json_encode([
                'grant_type' => 'client_credentials'
            ]),
            'use_generated_token_for_auth' => true,
            'allow_sending' => true,
            'allow_receiving' => true,
            'allow_custom_sender_id' => true,
            'use_as_sender_id' => true,
            'is_auto' => true,
            'available_countries' => json_encode(['AU', 'GB', 'AG', 'CY']),
            'message_sending_headers' => json_encode(['content-type: application/json']),
            'message_receiving_headers' => json_encode(['content-type: application/json']),
            'credentials' => json_encode(['applicationId' => '5c0c218ce4b07791c2ecc655', 'secret' => 'skMVqg6Gk8'])
        ]);
        $routee->services()->attach($virtualNumber);

    }
}
