<?php

namespace App\Core;

use PDO;

class Database
{
    public $connection;

    public function __construct(array $config)
    {
        $dsn ="mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

        $this->connection = new PDO($dsn, $config['username'], $config['password'],[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query) {
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }
}
