<?php
namespace Hauptmedia\Bundle\KafkaBundle\Consumer;

use Symfony\Component\Console\Output\OutputInterface;

class OutputConsumer implements ConsumerInterface {
    /**
     * @var OutputInterface
     */
    protected $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param $topic Topic name
     * @param $partition Partition
     * @param $offset Message offset
     * @param $payload Message payload
     * @param $key Optional message key
     * @return mixed
     */
    public function consume($topic, $partition, $offset, $key, $payload)
    {
        $this->output->writeln(
            implode(":", array($topic, $partition, $offset, $key, $payload))
        );
    }
}