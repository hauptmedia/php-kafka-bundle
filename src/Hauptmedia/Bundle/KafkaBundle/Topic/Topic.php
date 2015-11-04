<?php
namespace Hauptmedia\Bundle\KafkaBundle\Topic;

class Topic {
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}