<?php

declare(strict_types=1);

namespace Atmosphere\Development\Commands\Quality;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CsStyleFixerCommand extends Command
{
    protected static $defaultName = 'fix:code-style';

    protected static $defaultDescription = 'Fixes the code style of Atmosphere.';



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directories = [
            'Atmosphere',
            'Framework',
            'Website'
        ];

        foreach ($directories as $directory) {
            $output->writeln("Fixing code style for {$directory}...");

            $command = "PHP_CS_FIXER_IGNORE_ENV=1 php-cs-fixer fix {$directory} --rules=@PSR12";

            $output->writeln(shell_exec($command));
        }

        return Command::SUCCESS;
    }

}