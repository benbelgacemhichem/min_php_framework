<?php

namespace App\Core;

abstract class Migration
{
    public static $db;

    public function __construct()
    {
        $BASE_PATH = __DIR__ . '/../../';
        $dotenv = \Dotenv\Dotenv::createImmutable($BASE_PATH);
        $dotenv->load();

        $db_config  =  [
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'database' =>  $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4',
        ];

        self::$db = new \App\Core\Database($db_config);
    }

    public static function dropIfExists($tableName) {
       self::$db->query("DROP TABLE IF EXISTS $tableName");
    }
}
