<?php

use App\Core\Migration;

class m_2023_03_04_000000_create_users_table extends Migration
{
    public function up()
    {
        Migration::$db->query("CREATE TABLE `users` (
            `id` int NOT NULL AUTO_INCREMENT,
            `username` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp,
            PRIMARY KEY (id)
            ) ENGINE=InnoDB ")->fetch();
    }

    public function down()
    {
        Migration::dropIfExists('users');
    }
};
