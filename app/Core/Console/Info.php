<?php

namespace App\Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Info extends Command
{
   
    protected static $defaultName = 'info';

    protected static $defaultDescription = 'Test commande console!';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->success('Welcome to the php mini framework 🎉🎉');

        return Command::SUCCESS;
    }
}
