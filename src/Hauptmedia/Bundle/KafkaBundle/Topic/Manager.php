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
        $topic = new Topic();
        $topic->setName($name);

        $this->topics[] = $topic;
    }

    public function getTopics()
    {
        return $this->topics;
    }
}