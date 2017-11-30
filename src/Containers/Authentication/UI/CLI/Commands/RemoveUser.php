<?php
namespace App\Containers\Authentication\UI\CLI\Commands;

use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Ship\Command\CliInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveUser extends Command implements CliInterface
{
    protected function configure()
    {
        $this
            ->setName('user:remove')
            ->setHelp('user:remove @username')
            ->setDescription('Remove user filtered by username from database!')
            ->addArgument('username', InputArgument::REQUIRED, 'remove user by username');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $user = (new UserRepository())
            ->getById($input->getArgument('username'));

        if (null === $user) {
            $output->writeln('User '.$input->getArgument('username').' not found!');
            return;
        }
        $user->delete();
        $output->writeln('The user '.$input->getArgument('username').' deleted with success!');
    }
}
