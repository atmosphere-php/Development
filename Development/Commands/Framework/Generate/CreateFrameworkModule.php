<?php

declare(strict_types=1);

namespace Atmosphere\Development\Commands\Framework\Generate;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFrameworkModule extends Command
{
    protected static $defaultName = 'make:framework-module';

    protected function configure()
    {
        $this
            ->setDescription('Create a new framework module.')
            ->setHelp('This command allows you to create a new framework module.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the module.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Standardize the name.
        $name = ucfirst(strtolower($input->getArgument('name')));

        $output->writeln([
            'Framework Module Creator',
            '========================',
            "name: {$name}",
            '',
        ]);

        $path = __DIR__ . "/../../../../Framework/src/{$name}";

        // Check if the module already exists.
        if (is_dir($path)) {
            $output->writeln("The module '{$name}' already exists.");
            return Command::FAILURE;
        }

        if ( ! mkdir($path) && ! is_dir($path)) {
            $output->writeln("The module '{$name}' could not be created.");
            return self::FAILURE;
        }

        return Command::SUCCESS;
    }

}