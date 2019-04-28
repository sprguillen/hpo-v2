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
        ],
        'processor' => [
            'success' => [
                'store' => 'New processor has been created.',
                'update' => ':name processor has been updated.',
                'destroy' => 'Processor has been deleted.',
            ],
        ],
    ],
];
