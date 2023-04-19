<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['mongo_db']['active_config_group'] = 'default';

/**
 *  Connection settings for #default group.
 */
$config['mongo_db']['default'] = [
    'settings' => [
        'auth'             => TRUE,
        'debug'            => TRUE,
        'return_as'        => 'array',
        'auto_reset_query' => TRUE
    ],

    // *************************** Development Mode Start ************************


    'connection_string' => 'mongodb://admin:D3nv%24r5s@69.169.93.11:5829/4143db?authMechanism=SCRAM-SHA-256&directConnection=true&authSource=admin',

    'connection' => [
        'host'          => '69.169.93.11',
        'port'          => '5829',
        'user_name'     => 'admin',
        'user_password' => 'D3nv%24r5s',
        'db_name'       => '4143db',
        'db_options'    => []
    ],

     // *************************** Development Mode End *************************

    'driver' => []
];
/* End of file mongo_db.php */
/* Location: ./application/config/mongo_db.php */