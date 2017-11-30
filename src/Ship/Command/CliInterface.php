<?php
namespace App\Ship\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface CliInterface
 * @package App\Ship\Command
 */
interface CliInterface
{
    public function execute(InputInterface $input, OutputInterface $output);
}
