<?php

namespace App\Providers;
/*
use RdKafka\Conf;
use RdKafka\Producer;
use RdKafka\Consumer;
use RdKafka\KafkaConsumer;*/

use Illuminate\Support\ServiceProvider;

class ProducerServiceProvider extends ServiceProvider
{
    /**
     * Boot method
     *
     * @return void
     */
    public function boot()
    {
       /* $conf = new Conf();

        $conf->set('metadata.broker.list', env('KAFKA_BROKERS'));

        $conf->set('compression.codec', 'snappy');

        if (env('KAFKA_DEBUG', true)) {
            $conf->set('log_level', LOG_DEBUG);
            $conf->set('debug', 'all');
        }

        $this->app->bind(Producer::class, function () use ($conf) {
            $rd = new Producer($conf);
            return $rd;
        });*/
    }

    protected function getConfig()
    {
       /* $conf = new Conf();

        // Configure the group.id. All consumer with the same group.id will consume
        // different partitions.
        $conf->set('group.id', 'myConsumerGroup');

        // Initial list of Kafka brokers
        $conf->set('metadata.broker.list', env('KAFKA_BROKERS', 'kafka:9092'));

        // Set where to start consuming messages when there is no initial offset in
        // offset store or the desired offset is out of range.
        // 'smallest': start from the beginning
        $conf->set('auto.offset.reset', 'smallest');

        // Automatically and periodically commit offsets in the background
        $conf->set('enable.auto.commit', 'false');

        return $conf;*/
    }
}
