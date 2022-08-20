<?php

return [
    /*
    |--------------------------------------------------------------------------
    | List your email providers
    |--------------------------------------------------------------------------
    |
    | Enjoy a life with multimail
    |
    */

    'use_default_mail_facade_in_tests' => true,

    'emails' => [
        'mail@no-reply' => [
            'pass' => 'dc833d44bcff11d8afe14aa6bbbf6eaa-95f6ca46-c25eab7b',
            'username' => 'postmaster@sandbox4578e1720775484a8af0bcea600bfc13.mailgun.org',
            'from_name' => 'Maildoll',
        ],
    ],

    'provider' => [
        'default' => [
            'host' => 'smtp.mailgun.org',
            'port' => '587',
            'encryption' => 'tls',
        ],
    ],

];
