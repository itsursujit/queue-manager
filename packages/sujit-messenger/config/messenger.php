<?php

return [
    'default' => env('DEFAULT_MESSENGER_DRIVER', 'longcode'),
    'tables' => [
        'vendors_table' => 'vendors',
        'vendor_services_table' => 'vendor_services',
        'vendor_service_details_table' => 'vendor_service_details',
        'user_services_table' => 'user_services',
        'messenger_logs_table' => 'messenger_logs',
        'messenger_threads_table' => 'messenger_threads',
        'messenger_thread_messages_table' => 'messenger_thread_messages',
    ]
];
