<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*'],

    'allowed_methods' => [
        'POST',
        'GET',
        'OPTIONS',
        'PUT',
        'PATCH',
        'DELETE',
    ],

    'allowed_origins' => ['https://'.env('WEB_DOMAIN')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Content-Type',
        'X-Auth-Token',
        'X-XSRF-TOKEN',
        'X-CSRF-TOKEN',
        'X-Requested-With',
        'Origin',
        'Authorization',
    ],

    'exposed_headers' =>  [
        'Cache-Control',
        'Content-Language',
        'Content-Type',
        'Last-Modified',
    ],

    'max_age' => 0,

    'supports_credentials' => false,

];
