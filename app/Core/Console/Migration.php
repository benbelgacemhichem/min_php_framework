<?php

namespace App\Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Migration extends Command
{
    protected static $defaultName = 'migrate';

    protected static $defaultDescription = 'Migrate the database tables!';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $dir = dirname(dirname(__DIR__));

        $db_config  =  [
            'host' =>  '127.0.0.1',
            'port' =>3306,
            'database' => 'mini_framework',
            'username' => 'root',
            'password' =>  'password',
            'charset' => 'utf8mb4',
        ];

        $controller = new \App\Core\Database($db_config);

        $result = $controller->applayMigrations();

        if($result[0] === 'success'){
            $io->success($result[1]); 
        } else {
            $io->error($result[1]); 
        }

        return Command::SUCCESS;
    }
}
