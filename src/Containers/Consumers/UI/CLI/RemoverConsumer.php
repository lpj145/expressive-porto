<?php
namespace App\Containers\Consumers\UI\CLI;

use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Ship\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoverConsumer extends Command
{
    protected function configure()
    {
        $this
            ->setName('consumer:remove')
            ->setDescription('Remove consumer by identifier')
            ->setHelp('consumer:remove identifier ')
            ->addArgument('identifier', InputArgument::REQUIRED, 'identifier by consumer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $consumerId = $input->getArgument('identifier');
        $consumerRepo = $this->container->get(ConsumerRepository::class);
        if ($consumerRepo->deleteById($consumerId)) {
            $output->writeln('Consumer '.$consumerId.' deleted with success!');
        }

        $output->writeln('Consumer '.$consumerId.' not found this base or some error occurred!');
    }
}
