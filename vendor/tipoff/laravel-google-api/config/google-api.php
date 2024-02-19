<?php

return [
    'project_id' => env('GOOGLE_PROJECT_ID'),

    'client_id' => env('GOOGLE_CLIENT_ID'),

    'client_secret' => env('GOOGLE_CLIENT_SECRET'),

    'redirect_uri' => env('GOOGLE_REDIRECT_URI', '/'),

    'state' => null,

    'services' => [
        'search-console'    => [
            'status' => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'scopes' => [
                'https://www.googleapis.com/auth/webmasters',
                'https://www.googleapis.com/auth/webmasters.readonly'
            ]
        ],
        'my-business'       => [
            'status' => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'scopes' => [
                'https://www.googleapis.com/auth/business.manage'
            ]
        ],
        'youtube'           => [
            'status' => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'scopes' => [
                Google_Service_YouTube::YOUTUBE,
                //Google_Service_YouTube::YOUTUBE_CHANNEL_MEMBERSHIPS_CREATOR,
                //Google_Service_YouTube::YOUTUBE_FORCE_SSL,
                //Google_Service_YouTube::YOUTUBE_READONLY,
                //Google_Service_YouTube::YOUTUBE_UPLOAD,
                //Google_Service_YouTube::YOUTUBEPARTNER,
                //Google_Service_YouTube::YOUTUBEPARTNER_CHANNEL_AUDIT,
            ]
        ],
        'youtube-analytics' => [
            'status' => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'scopes' => [
                Google_Service_Analytics::ANALYTICS,
                //Google_Service_Analytics::ANALYTICS_EDIT,
                //Google_Service_Analytics::ANALYTICS_MANAGE_USERS,
                //Google_Service_Analytics::ANALYTICS_MANAGE_USERS_READONLY,
                //Google_Service_Analytics::ANALYTICS_PROVISION,
                //Google_Service_Analytics::ANALYTICS_READONLY,
                //Google_Service_Analytics::ANALYTICS_USER_DELETION,
            ]
        ],
        'analytics'         => [
            'status' => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'scopes' => [
                Google_Service_Analytics::ANALYTICS,
                //Google_Service_Analytics::ANALYTICS_EDIT,
                //Google_Service_Analytics::ANALYTICS_MANAGE_USERS,
                //Google_Service_Analytics::ANALYTICS_MANAGE_USERS_READONLY,
                //Google_Service_Analytics::ANALYTICS_PROVISION,
                //Google_Service_Analytics::ANALYTICS_READONLY,
                //Google_Service_Analytics::ANALYTICS_USER_DELETION,
            ]
        ],
        'places'            => [
            'status'     => Tipoff\GoogleApi\GoogleServiceStatus::ENABLED,
            'key'        => env('GOOGLE_PLACES_API_KEY'),
            'verify_ssl' => env('GOOGLE_PLACES_API_SSL', true),
            'headers'    => env('GOOGLE_PLACES_API_HEADERS', []),
        ]
    ]
];
