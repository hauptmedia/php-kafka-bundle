<?php
namespace Hauptmedia\Bundle\KafkaBundle\Consumer;

use Symfony\Component\Console\Output\OutputInterface;

class OutputConsumer implements ConsumerInterface {
    public function __construct()
    {
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
        echo implode(":", array($topic, $partition, $offset, $key, $payload)).PHP_EOL;
    }
}