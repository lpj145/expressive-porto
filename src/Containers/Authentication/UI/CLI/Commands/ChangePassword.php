<?php
namespace App\Containers\Authentication\UI\CLI\Commands;

use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Ship\Command\CliInterface;
use AuthExpressive\Model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangePassword extends Command implements CliInterface
{
    protected function configure()
    {
        $this
            ->setName('user:password')
            ->setDescription('If you need change password...')
            ->setHelp('user:password password(not required)')
            ->addArgument('username', InputArgument::REQUIRED, 'username to filter')
            ->addArgument('password', InputArgument::OPTIONAL, 'password - optional');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password') ?? substr(sha1(random_bytes(16)), 0, 8);

        $userModel = (new UserRepository())
            ->getById($username);

        if (null === $userModel) {
            $output->writeln('The user '.$username.' not found!');
            return;
        }

        $userModel['password'] = $password;
        $user = new User($userModel);
        $userModel->fill($user->toArray());
        $userModel->update();
        $output->writeln('Password changed to '.$password.' from user '.$username.'!');
        return;
    }
}
