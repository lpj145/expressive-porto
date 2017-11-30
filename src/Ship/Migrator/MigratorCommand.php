<?php
namespace App\Ship\Migrator;

use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigratorCommand extends \App\Ship\Command\Command
{
    protected function configure()
    {
        $this
            ->setName('migrations')
            ->setHelp('Enter migration name on Ship\\Migrations Folder')
            ->setDescription('Enter migration name on Ship\\Migrations Folder')
            ->addArgument('migration', InputArgument::REQUIRED, 'enter migration name')
            ->addArgument('action', InputArgument::OPTIONAL, 'default: commit, or remove');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $migrationClass = 'App\\Ship\\Migrations\\'.$input->getArgument('migration');
        $action = $input->getArgument('action') ?? 'commit';
        $class = new $migrationClass($this->container->get(Manager::class));

        if ($action === 'commit') {
            $output->writeln('Migration '.$migrationClass.' a migrated with success!');
            return $class->init();
        }

        if ($action === 'remove') {
            $output->writeln('Migration '.$migrationClass.' a removed with success!');
            return $class->down();
        }

        $output->writeln('Migration '.$migrationClass.' not found action yet!');
        return null;
    }
}
