<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | HTTP Basic Authentication Credentials
    |--------------------------------------------------------------------------
    |
    | Here you may specify the credentials which should be used to authenticate
    | users with HTTP Basic Authentication. You may specify multiple sets of
    | credentials which may be used to authenticate different users or user
    | types. The default set will be used if no specific set is requested.
    |
    */

    'credentials' => [
        'default' => [
            'username' => env('BASIC_AUTH_USER'),
            'password' => env('BASIC_AUTH_PASSWORD'),
        ],
    ],
];
