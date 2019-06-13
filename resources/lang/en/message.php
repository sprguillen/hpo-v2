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
            'error' => [
                'dispatcher_not_found' => 'Dispatcher given is not valid.',
            ],
            'manage' => [
                'error' => [
                    'invalid_payment_mode' => 'Invalid payment mode value, please enter between Cash or Charge.',
                ],
                'success' => [
                    'update_payment_mode' => 'Client payment mode has been updated.',
                    'update_dispatcher' => 'Client dispatcher mode has been updated.',
                ]
            ],
            'source' => [
                'success' => [
                    'store' => 'Source has been added to :name client.',
                    'destroy' => 'Source has been removed from this client.',
                ],
            ],
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
                'import' => 'Importing services successful.',
            ],
            'not_found' => 'Service not found.',
            'user_not_client' => 'User is not a client.',
            'client' => [
                'success' => [
                    'store' => ':name client has been added to service.',
                    'update' => ':name has been updated price successfully.',
                    'destroy' => 'Client has been remove on this service.',
                ],
            ]
        ],
        'system' => [
            'source' => [
                'success' => [
                    'store' => 'New source has been created.',
                    'update' => ':name source has been updated.',
                    'destroy' => 'Source has been deleted.',
                ],
            ],
            'dispatcher' => [
                'success' => [
                    'store' => 'New dispatcher has been created.',
                    'update' => ':name dispatcher has been updated.',
                    'destroy' => 'Dispatcher has been deleted.',
                ]
            ],
            'patient_type' => [
                'success' => [
                    'store' => 'New patient type has been created.',
                    'update' => ':name patient type has been updated.',
                    'destroy' => 'Patient type has been deleted.',
                ],
            ],
            'white_listed_ip' => [
                'success' => [
                    'store' => 'New ip has been added to white list.',
                    'update' => 'White listed ip has been updated.',
                    'destroy' => 'IP has been deleted.',
                ],
            ],
        ]
    ],

    // client messages
    'client' => [
        'staff' => [
            'success' => [
                'store' => 'New staff has been added.',
                'update' => 'Staff has been updated.',
                'archived' => 'Staff has been archived.',
            ],
        ],
        'patient' => [
            'success' => [
                'store' => 'New patient has been added.',
                'update' => 'Patient has been updated.',
                'archived' => 'Patient has been archived.',
            ],
            'error' => [
                'patient_not_owned' => 'You are not the client on this patient.',
            ]
        ],
    ],
];
