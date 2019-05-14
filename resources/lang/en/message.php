<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'auth' => [
        'login' => [
            'error' => [
                'credentials' => 'Email or password does not match.',
                'already_login' => 'You are already logged in.',
            ],
            'success' => 'You are logged in. Please wait.',
        ],
        'password' => [
            'reset' => [
                'send' => 'An email has been sent to :email.',
                'success' => 'Your\'e password has been reset.',
            ]
        ],
    ],

    /**
     * Admin messages
     */
    'admin' => [
        'client' => [
            'success' => [
                'store' => 'New client has been created.',
                'update' => ':name client has been updated.',
                'destroy' => 'Client has been deleted.',
            ],
            'manage' => [
                'error' => [
                    'invalid_payment_mode' => 'Invalid payment mode value, please enter between Cash or Charge.',
                ],
                'success' => [
                    'update_payment_mode' => 'Client payment mode has been updated.',
                ]
            ]
        ],
        'processor' => [
            'success' => [
                'store' => 'New processor has been created.',
                'update' => ':name processor has been updated.',
                'destroy' => 'Processor has been deleted.',
            ],
        ],
        'service' => [
            'success' => [
                'store' => 'New service has been created.',
                'update' => ':name service has been updated.',
                'destroy' => 'Service has been deleted.',
            ]
        ],
        'system' => [
            'source' => [
                'success' => [
                    'store' => 'New source has been created.',
                    'update' => ':name source has been updated.',
                    'destroy' => 'Source has been deleted.',
                ],
            ]
        ]
    ],
];
