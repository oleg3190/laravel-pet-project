<?php

namespace App\repo;

use App\Contracts\SearchBookRepository;
use App\Models\Book;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchBookRepository implements SearchBookRepository
{
    private $elasticsearch;
    private $model;


    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
        $this->model = new Book;
    }

    public function search(string $query = ''): Collection
    {
        $items = $this->execElastic($query);


        return $this->getItems($items);
    }

    public function setIndexForAllItems()
    {
        foreach ($this->model::cursor() as $item) {
            $this->elasticsearch->index([
                'index' => $item->getTable(),
                'type' => $item->getTable(),
                'id' => $item->getKey(),
                'body' => $item->toArray(),
            ]);
        }
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
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return $this->model::find($ids);
    }
}
