<?php

namespace App\Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MigrationFresh extends Command
{
    protected static $defaultName = 'migrate:fresh';

    protected static $defaultDescription = 'Refresh database migration!';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $BASE_PATH = __DIR__ . '/../../../';

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

        $db = new \App\Core\Database($db_config);

        $result = $db->refresh();

        if($result[0] === 'success'){
            $io->success($result[1]); 
        } else {
            $io->error($result[1]); 
        }

        return Command::SUCCESS;
    }
}
