<?php

namespace App\servises;

use App\servises\Elastic\ElasticSearchFormatter;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class EsLogger {

    /**
     * @param array $config
     * @return LoggerInterface
     */
    public function __invoke(array $config): LoggerInterface
    {
        $handler = new SocketHandler("udp://{$config['host']}:{$config['port']}");
        $handler->setFormatter(new ElasticSearchFormatter(config('app.name')));

        return new Logger('logstash.main', [$handler]);
    }

}