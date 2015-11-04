<?php
namespace Hauptmedia\Bundle\KafkaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DumpTopicsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setDefinition(array())
            ->setName('hauptmedia:kafka:dump-topics');
    }

    protected function execute(InputInterface $input,  OutputInterface $output)
    {
        $topics = $this->getContainer()->get('hauptmedia.kafka')->getTopics();

        var_dump($topics);

    }
}
