<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class StartWorkerCommand extends Command
{
    protected static $defaultName = 'worker:start';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $consumers = ['amqp_order', 'amqp_order_done'];

        foreach ($consumers as $consumer) {
            $output->writeln("Consumer worker started!\n");

            $process = new Process('php /var/www/html/bin/console messenger:consume-messages ' . $consumer);
            $process->start();
        }
    }
}