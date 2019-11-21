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

    'github' => [
    'client_id' => 'c120be67772e21b32e97',
    'client_secret' => '73be29d0a6796262374ebc1f25c238aedde69d55',
    'redirect' => 'http://localhost:8000/auth/github/callback',
    ],

    'facebook' => [
    'client_id' => '290394918077624',
    'client_secret' => 'c906df67af76fe9eed39b07ca0117ffc',
    'redirect' => 'http://portal.fonsodi.com/public/auth/facebook/callback',
    ],

];
