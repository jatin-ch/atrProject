<?php
return [

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | If you're using API credentials, change these settings. Get your
    | credentials from https://dashboard.nexmo.com | 'Settings'.
    |
    */

    //'api_key' => function_exists('env') ? env('NEXMO_KEY', '') : 'dc5f8811',
    //'api_secret' => function_exists('env') ? env('NEXMO_SECRET', '') : '5a2e3ca29b53f1eb',
    'api_key' => 'dc5f8811',
    'api_secret' => '5a2e3ca29b53f1eb',

    /*
    |--------------------------------------------------------------------------
    | Signature Secret
    |--------------------------------------------------------------------------
    |
    | If you're using a signature secret, use this section. This can be used
    | without an `api_secret` for some APIs, as well as with an `api_secret`
    | for all APIs.
    |
    */

    'signature_secret' => function_exists('env') ? env('NEXMO_SIGNATURE_SECRET', '') : '',

];
