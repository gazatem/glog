<?php
return [

    'appname'   => 'Glog UI',
    // Choose your service: local or remote
    // we allow you run glog local with limited features
    // if you wish to use our service enter 'remote' in service option
    // and your api key
    // To get your api key, browse to www.loggfy.com

    'service' => env('GLOG_SERVICE', 'local'),

    // #########################################################
    // L O C A L  S E T T I N G S
    //
    // if you will run glog on local need to update these settings

    // Secure your log panel
    'middlewares' => ['web'],

    // glog uses mysql default, but can be choose mongodb
    'db_connection' => env('DB_CONNECTION', 'mysql'),

    // To create an alert, enter level and channel pair here
    // Example: 'notification' => ['test-channel' => ['CRITICAL', 'ALERT']],
    'notification' => [],
    'mail_subject' => 'Glog notification mail',
    'mail_to' => env('MAIL_FROM'),
    'translations' => [
        'test-channel' => 'A sample channel'
    ],

    // Panel route path
    'route-prefix' => 'logs',
 

    // Common settings!

    // All channels must be entered before to send the API.
    'levels' => ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR', 'WARNING', 'NOTICE', 'INFO', 'DEBUG'],
    'channels' => ['test-channel', 'page.home', 'page.shop', 'page.blog', 'auth.login', 'auth.register'],
];
