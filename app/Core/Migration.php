<?php

namespace App\Core;

abstract class Migration
{
    public $db;

    public function __construct()
    {

        $db_config  =  [
            'host' =>  '127.0.0.1',
            'port' => 3306,
            'database' => 'mini_framework',
            'username' => 'root',
            'password' =>  'password',
            'charset' => 'utf8mb4',
        ];

        $this->db = new \App\Core\Database($db_config);
    }
}
