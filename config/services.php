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

    /*
     * Socialite services:
     */
    'facebook' => [
        'client_id' => '122264405094716',
        'client_secret' => 'a0d6de3b94d8160c2f008590418c5606',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '49335660341-k98bppthtm0r3am3gmh02v2qnirvkvrq.apps.googleusercontent.com',
        'client_secret' => '3BaiE84kEHWhXS9QGfnCsesA',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

    'twitter' => [
        'client_id' => 'your-twitter-app-id',
        'client_secret' => 'your-twitter-app-secret',
        'redirect' => 'http://your-callback-url',
    ],
    /*
     *
    'github' => [
        'client_id' => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect' => 'http://your-callback-url',
    ],

    'linkedin' => [
        'client_id' => 'your-linkedin-app-id',
        'client_secret' => 'your-linkedin-app-secret',
        'redirect' => 'http://your-callback-url',
    ],

    'twitter' => [
        'client_id' => 'your-twitter-app-id',
        'client_secret' => 'your-twitter-app-secret',
        'redirect' => 'http://your-callback-url',
    ],

    'vk' => [
        'client_id' => 'your-vk-app-id',
        'client_secret' => 'your-vk-app-secret',
        'redirect' => 'http://your-callback-url',
    ],
    */
];
