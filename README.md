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

hauptmedia_kafka:
  topics:
    test:
      brokers:
        - hostname1
        - hostname2
```
