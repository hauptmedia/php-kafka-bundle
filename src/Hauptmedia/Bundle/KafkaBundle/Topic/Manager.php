<?php
namespace Hauptmedia\Bundle\KafkaBundle\Topic;

class Manager {
    protected $topics;

    public function __construct()
    {
        $this->topics = [];
    }

    public function addTopic($name, array $conf)
    {
        $producer = new \RdKafka\Producer();
        $producer->addBrokers(implode(',', $conf['brokers']));

        $producerTopicConf = new \RdKafka\TopicConf();
        $producerTopic = $producer->newTopic($name, $producerTopicConf);

        $consumer = new \RdKafka\Consumer();
        $consumer->addBrokers(implode(',', $conf['brokers']));

        $consumerTopicConf = new \RdKafka\TopicConf();
        $consumerTopicConf->set("auto.commit.interval.ms", 1e3);
        $consumerTopicConf->set("offset.store.sync.interval.ms", 60e3);
        $consumerTopic = $consumer->newTopic($name, $consumerTopicConf);

        $topic = new Topic($name, $producer, $producerTopic, $consumer, $consumerTopic);

        $this->topics[$name] = $topic;
    }

    /**
     * @param $name
     * @return Topic
     */
    public function getTopic($name)
    {
        return array_key_exists($name, $this->topics) ?
            $this->topics[$name] : null;
    }

    public function getTopics()
    {
        return array_values($this->topics);
    }
}