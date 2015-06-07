<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Exception Driver
    |--------------------------------------------------------------------------
    |
    | This option will determine the catch exceptions provided. It captures
    | all the errors and sends it to the specified drive. Supported drives
    | are as follows.
    |
    | Supported: "log", "bugsnag", "sentry"
    |
    */

    'driver' => 'log',

    /*
    |--------------------------------------------------------------------------
    | Exception Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    */

    'connections' => [

        'bugsnag' => [
            'key' => '',
        ],

        'sentry' => [
            'project' => '',
            'public' => '',
            'secret' => '',
        ],

    ],

];
