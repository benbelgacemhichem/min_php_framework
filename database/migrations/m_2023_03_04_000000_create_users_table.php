<?php

use App\Core\Migration;

class m_2023_03_04_000000_create_users_table extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `users` (
            `id` int NOT NULL,
            `username` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL
            ) ENGINE=InnoDB ")->fetch();
    }

    public function down()
    {
        echo 'Down migration' . PHP_EOL;
        // Migration::dropIfExists('users');
    }
};
