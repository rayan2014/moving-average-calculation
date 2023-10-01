<?php
return [

    "date_column_name" => "Date",
    "visitors_column_name" => "Visitors",
    "moving_average_column_name" => "Moving Average",

    'credentials' => [
        'type' => 'service_account',
        'project_id' => env('GOOGLE_PROJECT_ID', 'it-masters-1599598697284'),
        'private_key_id' => env('GOOGLE_PRIVATE_KEY_ID', '18ffb3fdb54151c419f62d7d0f12cd6e67440216'),
        'private_key' => env('GOOGLE_PRIVATE_KEY'),
        'client_email' => env('GOOGLE_CLIENT_EMAIL', 'moving-average@it-masters-1599598697284.iam.gserviceaccount.com'),
        'client_id' => env('GOOGLE_CLIENT_ID', '101932397335165315745'),
        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri' => 'https://oauth2.googleapis.com/token',
        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
        'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/moving-average%40it-masters-1599598697284.iam.gserviceaccount.com',
        'universe_domain' => 'googleapis.com',
    ],

];
