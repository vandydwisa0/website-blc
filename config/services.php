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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'apiKey' => env('FIREBASE_API_KEY'),
        'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
        'projectId' => env('FIREBASE_AUTH_DOMAIN'),
        'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
        'messagingSenderId' => env('FIREBASE_MESSAGIN_SENDER_ID'),
        'appId' => env('FIREBASE_APP_ID'),
        'measurementId' => env('FIREBASE_MEASUREMENT_ID'),
        // 'storage_bucket' => 'gs://bimbel-blc.appspot.com',
    ],

    // 'firebase' => [
    //     'apiKey' => 'AIzaSyBIpXCoxMW3BD8mrRG0fORXVrwhqvrjiaM',
    //     'authDomain' => 'bimbel-blc.firebaseapp.com',
    //     'projectId' => 'bimbel-blc',
    //     'storageBucket' => 'bimbel-blc.appspot.com',
    //     'messagingSenderId' => '852604894387',
    //     'appId' => '1:852604894387:web:0240bd43e27cf9154884c6',
    //     'measurementId' => 'G-GRM8815LCT',
    // ],
];
