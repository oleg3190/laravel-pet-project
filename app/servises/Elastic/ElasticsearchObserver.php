<?php

namespace App\servises\Elastic;

use Elastic\Elasticsearch\Client;

class ElasticsearchObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved($model)
    {
        $this->elasticsearch->index([
            'index' => $model->getTable(),
            'type' => $model->getTable(),
            'id' => $model->getKey(),
            'body' => $model->toArray(),
        ]);
    }

    public function deleted($model)
    {
        $this->elasticsearch->delete([
            'index' => $model->getTable(),
            'type' => $model->getTable(),
            'id' => $model->getKey(),
        ]);
    }
}
