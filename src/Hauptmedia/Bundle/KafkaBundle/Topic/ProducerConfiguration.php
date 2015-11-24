<?php
namespace Hauptmedia\Bundle\KafkaBundle\Topic;

/**
 * See https://github.com/edenhill/librdkafka/blob/master/CONFIGURATION.md
 *
 * Class ProducerConfiguration
 * @package Hauptmedia\Bundle\KafkaBundle\Topic
 */
class ProducerConfiguration
{
    public function toRdKafkaTopicConfig() {
        $topicConf = new \RdKafka\TopicConf();
    }
}