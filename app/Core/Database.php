<?php

namespace App\Core;

use PDO;

class Database
{
    public $connection;

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

        $this->connection = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function applayMigrations()
    {
        $migration_path = __DIR__ . '/../../database/migrations';
        self::creaetMigrationTable();
        $applayedMigrations = self::getApplayedMigrations();

        $migrationsFiles = scandir($migration_path);

        $migrations = array_diff($migrationsFiles, $applayedMigrations);

        foreach($migrations as $migration) {
            if($migration === '.' || $migration === '..') {
                continue;
            }

            require_once "$migration_path/$migration";
            $migrationClassName = pathinfo($migration, PATHINFO_FILENAME);

            $migrationInstance = new $migrationClassName();
            echo "Appling migration $migration ".PHP_EOL;
            $migrationInstance->up();
            echo "Applied migration $migration " . PHP_EOL;

            $newMigrations[] = $migration;
        }

        if(! empty($newMigrations)) {
            self::saveMigarations($newMigrations);
        }else {
            return [
                "success",
                "All migrations are applied 🎉🎉"
            ]; 
        }
    } 

    public function creaetMigrationTable()
    {
        self::query("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;")->fetch();
    }
    
    public function getApplayedMigrations()
    {
        return  self::query('select migration from migrations')->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function saveMigarations(array $migrations)
    {
        $migrations = implode(',',array_map(fn($m) => "('$m')", $migrations));

        return  self::query("INSERT INTO migrations (migration) VALUES (
            $migrations
        )");

    }

    public function query($query)
    {
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }
}
