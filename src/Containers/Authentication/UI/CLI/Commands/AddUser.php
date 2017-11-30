<?php
namespace App\Containers\Authentication\UI\CLI\Commands;

use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Ship\Command\CliInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUser extends Command implements CliInterface
{

    protected function configure()
    {
        $this
            ->setName('user:add')
            ->setDescription('Register new user on database!')
            ->setHelp('app:user-add JohnDoe john@example.com passwordHere')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of user')
            ->addArgument('username', InputArgument::REQUIRED, 'username to login')
            ->addArgument('password', InputArgument::REQUIRED, 'password alpha');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $attributes = [
            'name' => $input->getArgument('name'),
            'username' => $input->getArgument('username'),
            'password' => $input->getArgument('password'),
            'active' => true,
            'abilities' => [
                'admin' => true
            ]
        ];

        (new UserRepository())
            ->save($attributes);
        $output->writeln('Saved '.$attributes['username'].' with success!');
    }
}
