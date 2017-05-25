# HauptmediaKafkaBundle

## Installation

### Step 1: Download Kafka-Bundle using composer

``` bash
$ composer require hauptmedia/kafka-bundle
```

### Step 2: Enable the bundle in your application kernel

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

### Step 3: Setting Configuration

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

### Step 4: Enjoy!!!
        