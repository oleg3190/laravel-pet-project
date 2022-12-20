<?php

namespace App\servises;

use Exception;
use Psr\Container\ContainerInterface;
use RdKafka\Producer;
use RdKafka\KafkaConsumer;

class KafkaProducer
{
    protected $payload;

    protected $topic;

    protected $producer;

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }


    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    public function getTopic()
    {
        if (!$this->topic) {
            throw new Exception('Topic is not set');
        }

        return $this->topic;
    }

    public function send(string $message, $key = null, array $headers = [])
    {
        $this->buildPayload($message, $headers);

        $topic = $this->producer->newTopic($this->getTopic());

        // RD_KAFKA_PARTITION_UA, lets librdkafka choose the partition.
        // Messages with the same "$key" will be in the same topic partition.
        // This ensure that messages are consumed in order.
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $this->payload, $key);

        // pull for any events
        $this->producer->poll(0);

        $this->flush();
    }

    protected function flush(int $timeout = 10000)
    {
        $result = $this->producer->flush($timeout);

        if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
            throw new Exception('librdkafka unable to perform flush, messages might be lost');
        }
    }

    protected function buildPayload(string $message, array $headers = [])
    {
        $this->payload = json_encode([
            'body' => $message,
            'headers' => $headers
        ]);
    }
}
