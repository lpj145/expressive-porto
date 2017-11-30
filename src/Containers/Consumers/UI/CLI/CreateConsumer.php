<?php
namespace App\Containers\Consumers\UI\CLI;

use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Ship\Command\Command;
use App\Ship\Helpers\HashBytes;
use App\Ship\Repositories\AbstractRepository;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateConsumer extends Command
{
    use HashBytes;

    protected function configure()
    {
        $this
            ->setName('consumer:create')
            ->setDescription('Create a consumer to access api by the key')
            ->addArgument('name', InputArgument::REQUIRED, 'required name for owner')
            ->addArgument('identifier', InputArgument::REQUIRED, 'unique identifier for this consumer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $attributes = [
            'identifier' => $input->getArgument('identifier'),
            'name' => $input->getArgument('name'),
            'active' => true,
            'key' => $this->randomByte()
        ];

        $consumerRepository = $this->container->get(ConsumerRepository::class);
        if ($consumerRepository->save($attributes)) {
            $output->writeln('Consumer '.$attributes['name'].' created with success, consumer key: '.$attributes['key']);
            return;
        }

        $output->writeln('Consumer '.$attributes['name'].' not created!');
    }
}
