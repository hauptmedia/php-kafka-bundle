<?php
namespace Hauptmedia\Bundle\KafkaBundle\Consumer;

interface ConsumerInterface
{
    /**
     * @param $topic Topic name
     * @param $partition Partition
     * @param $offset Message offset
     * @param $payload Message payload
     * @param $key Optional message key
     * @return mixed
     */
    public function consume($topic, $partition, $offset, $payload, $key);
}
