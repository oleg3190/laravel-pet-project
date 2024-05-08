<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RdKafka\Producer;
use RdKafka\KafkaConsumer;
use RdKafka\TopicPartition;
use App;
use Psr\Container\ContainerInterface;

class KafkaController extends Controller
{
    public function __construct(Producer $container)
    {
        $this->container = $container;
    }
    public function get()
    {

        $br = $this->container;

        $allInfo = $br->metadata(true, NULL, 60e3);

        $topics = $allInfo->getTopics();
        $data = [];
        foreach ($topics as $topic) {

            $partitions = $topic->getPartitions();

            foreach ($partitions as $partition) {
                $data[] = new \RdKafka\TopicPartition($topic->getTopic(), $partition->getId());
            }
        }
        dd($data);
    }
}
