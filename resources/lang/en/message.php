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
