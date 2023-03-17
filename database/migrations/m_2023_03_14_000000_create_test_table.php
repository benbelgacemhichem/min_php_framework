<?php

use App\Core\Migration;

class m_2023_03_14_000000_create_test_table extends Migration
{
    public function up()
    {
        Migration::$db->query("CREATE TABLE `test` (
            `id` int NOT NULL AUTO_INCREMENT,
            `description` varchar(255) NOT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp,
            PRIMARY KEY (id)
            ) ENGINE=InnoDB ")->fetch();
    }

    public function down()
    {
        Migration::dropIfExists('test');
    }
};
