<?php
namespace Hauptmedia\Bundle\KafkaBundle\Command;

use Hauptmedia\Bundle\KafkaBundle\Consumer\OutputConsumer;
use Hauptmedia\Bundle\KafkaBundle\Topic\Topic;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeTopicCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setDefinition(array())
            ->addArgument('topic', InputArgument::REQUIRED, 'Topic')
            ->addOption('partition', "p", InputOption::VALUE_REQUIRED, 'Partition')
            ->setName('hauptmedia:kafka:topic:consume');
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input,  OutputInterface $output)
    {
        $topicName = $input->getArgument('topic');
        $topic = $this->getContainer()->get('hauptmedia.kafka')->getTopic($topicName);

        if(!$topic) {
            throw new \Exception("Unknown topic $topicName");
        }

        $partition = $input->getOption('partition');

        if(!is_numeric($partition) || $partition < 0) {
            throw new \Exception("Partition needs to be a number in the range 0..2^32-1");
        }

        $topic->consume($partition);
    }
}
