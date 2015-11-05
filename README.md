# HauptmediaKafkaBundle

## Installation

### Add the dependency in your composer.json

```js
{
    "require": {
        "hauptmedia/kafka-bundle": "dev-master"
    }
}
```

### Enable the bundle in your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Hauptmedia\Bundle\KafkaBundle\HauptmediaKafkaBundle(),
    );
}
```

## Configuration

```yaml
# app/config.yml

services:
  output_consumer_service:
    class: Hauptmedia\Bundle\KafkaBundle\Consumer\OutputConsumer
    
hauptmedia_kafka:
  topics:
    test:
      brokers:
        - hostname1
        - hostname2
        
      consumer_services:
        - output_consumer_service
```
        