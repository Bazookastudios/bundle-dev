<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @package Command
 */
class TestCommand extends Command
{
    /**
     * @inheritdoc
     * @throws InvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('crons:run:test');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln('It works!');
    }
}
