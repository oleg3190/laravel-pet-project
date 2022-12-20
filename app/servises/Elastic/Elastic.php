<?php

namespace App\Servises\Elastic;

use Elastic\Elasticsearch\Client;

class Elastic
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index(array $parameters)
    {
        return $this->client->index($parameters);
    }

    public function delete(array $parameters)
    {
        return $this->client->delete($parameters);
    }

    public function search(array $parameters)
    {
        return $this->client->search($parameters);
    }
}
