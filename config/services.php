<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'firebase' => [
        'databaseURL' => env('FIREBASE_DATABASE_URL'),
        'apiKey' => env('FIREBASE_API_KEY'),
        'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
        'projectId' => env('FIREBASE_PROJECT_ID'),
        'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
        // 'apiKey' => "AIzaSyC_vxSuLnDDWbJDOiP6aDWw334mVY5ZdG8",
        // 'authDomain' => "laravel-inertia-996f5.firebaseapp.com",
        // 'databaseURL' => "https://laravel-inertia-996f5-default-rtdb.firebaseio.com",
        // 'projectId' => "laravel-inertia-996f5",
        // 'storageBucket' => "laravel-inertia-996f5.appspot.com",
        // 'messagingSenderId' => "19479149469",
        // 'appId' => "1:19479149469:web:9e8c55201fb278173d0d74",
        // 'measurementId' => "G-D62FGQ4QBT"
    ]

];
