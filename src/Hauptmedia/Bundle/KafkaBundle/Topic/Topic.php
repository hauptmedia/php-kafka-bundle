<?php
namespace Hauptmedia\Bundle\KafkaBundle\Topic;

use Hauptmedia\Bundle\KafkaBundle\Consumer\ConsumerInterface;

class Topic {
    const PARTITION_UA = RD_KAFKA_PARTITION_UA;

    /**
     * @var \RdKafka\Producer
     */
    protected $rdKafkaProducer;

    /**
     * @var \RdKafka\ProducerTopic
     */
    protected $rdKafkaProducerTopic;

    /**
     * @var \RdKafka\Consumer
     */
    protected $rdKafkaConsumer;

    /**
     * @var \RdKafka\ConsumerTopic
     */
    protected $rdKafkaConsumerTopic;

    /**
     * @var ConsumerInterface[]
     */
    protected $consumers = array();

    protected $name;

    public function __construct(
        $name,
        \RdKafka\Producer $rdKafkaProducer = null,
        \RdKafka\ProducerTopic $rdKafkaProducerTopic = null,
        \RdKafka\Consumer $rdKafkaConsumer = null,
        \RdKafka\ConsumerTopic $rdKafkaConsumerTopic = null
    )
    {
        $this->name = $name;
        $this->rdKafkaProducer = $rdKafkaProducer;
        $this->rdKafkaProducerTopic = $rdKafkaProducerTopic;
        $this->rdKafkaConsumer = $rdKafkaConsumer;
        $this->rdKafkaConsumerTopic = $rdKafkaConsumerTopic;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addConsumer(ConsumerInterface $consumer)
    {
        $this->consumers[] = $consumer;
    }

    /**
     * Produce and send a single message to broker
     * @param $payload is the message payload
     * @param $key is an optional message key, if non-NULL it will be passed to the topic partitioner as well as be sent with the message to the broker and passed on to the consumer.
     * @param int $partition is the target partition, either Topic::PARTITION_UA (unassigned) for automatic partitioning using the topic's partitioner function, or a fixed partition (0..N)
     */
    public function produce($payload, $key=null, $partition=Topic::PARTITION_UA)
    {
        $this->rdKafkaProducerTopic->produce($partition, 0, $payload, $key);
    }

    public function consume($partition=Topic::PARTITION_UA)
    {
        $partition=0;

        if(!$this->consumers) {
            throw new \Exception("Topic ".$this->name." has no registered consumers");
        }

        if(!$this->rdKafkaConsumerTopic) {
            throw new \Exception("Topic ".$this->name." is not registered as consumer topic");
        }

        $this->rdKafkaConsumerTopic->consumeStart($partition, RD_KAFKA_OFFSET_BEGINNING);

        while($message = $this->rdKafkaConsumerTopic->consume($partition, 10000)) {
            foreach($this->consumers as $consumer) {
                $consumer->consume($message->topic_name, $message->partition, $message->offset, $message->key, $message->payload);
            }
        }
        $this->rdKafkaConsumerTopic->consumeStop($partition);
    }
}