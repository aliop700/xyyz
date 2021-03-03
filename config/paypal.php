<?php 
return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','AbiYw-cjDDsaJZPgD51Mz_9mSHNWj5OZC0YjjyJkDJ_1owqcrjo0go4XYREO5o4i0-nvDJE0jR6OIAmY'),
    'secret' => env('PAYPAL_SECRET','EJBVHqUS1LuL04bOXhFLLlQxDnPZE3LU9jx-RTWmbrUU-p1TB5NMLcS1WmX0aKqdMGQqw--YdGzjjqCN'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];
?>