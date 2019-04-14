<?php

namespace App\Command;

use App\Service\RabbitMqService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test:test';

    private $rabbit;

    public function __construct(RabbitMqService $rabbit)
    {
        $this->rabbit = $rabbit;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("This is output from a sf command (out int)\n");
        $this->rabbit->send([]);
    }
}