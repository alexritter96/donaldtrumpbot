<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'twitter' => [
        'client_id' => 'YJ3mddpo40YhkctIi6r5bxAE1',
        'client_secret' => 'wdVBMFxdOKJJphFqI9n7DrLgRWsqImL9DCiN5cfN6wfDSrleT7',
        'redirect' => 'http://your-callback-url',
        'access_token' => '821799234269802498-FLo8lMZ79DbVnbAzwH5u7x03XSq84fE',
        'access_token_secret' => 'EojfEfEGgOZiX9YuVFhdSCXzy4hfZVvqb1OM2mzdEjn4N',
    ],

];
