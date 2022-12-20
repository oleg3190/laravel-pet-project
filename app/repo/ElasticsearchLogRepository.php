<?php

namespace App\repo;

use App\Contracts\SearchBookRepository;
use App\Models\Book;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchLogRepository
{
    private $elasticsearch;


    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): Collection
    {
        $items = $this->execElastic($query);


        return $this->getItems($items);
    }

    private function execElastic(string $query = '')
    {
        $index = $this->model->getTable();
        $items = $this->elasticsearch->search([
            //'scroll' => '30s', // how long between scroll requests. should be small!
            //'size'   => 50, 
            'index' => $index,
            'type' => $index,
            'body' => [

                'query' => [
                    /* 'multi_match' => [
                        'fields' => ['title', 'author'],
                        'query' => $query,
                        "type" => "phrase_prefix",
                    ],*/
                    'multi_match' => [
                        'fields' => ['title', 'author'],
                        'query' => $query,
                        "type" => "phrase_prefix",
                        "operator" =>   "and"
                    ],
                ]
            ],

        ]);

        return $items;
    }

    private function getItems(Elasticsearch $items): Collection
    {
        return $items['hits'];
    }
}
