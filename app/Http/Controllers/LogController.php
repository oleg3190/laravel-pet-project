<?php

namespace App\Http\Controllers;

use App\Contracts\BooksRepository;
use App\Contracts\SearchBookRepository;
use Elastic\Elasticsearch\Client;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function log(){
        Log::channel('logstash')->debug('Logging to logstash');
    }

    public function saved($model)
    {
        $this->elasticsearch->index([
            'index' => 'logs',
            'type' => 'logs',
            'id' => 34,
            'body' => [
                'properties'=> [
                    "appVersion" =>  [
                        "type" => "keyword",
                    ],
                    "clientApplication" =>  [
                        "type" => "keyword",
                    ],
                    "uid" =>  [
                        "type" => "keyword",
                    ],
                    "ip" =>  [
                        "type" => "ip",
                    ],
                    "usage_date" => [
                        "type" => "date",
                        "format"  => "yyyy-MM-dd HH:mm:ss"
                    ],
                    "os" =>  [
                        "type" => "keyword",
                    ]
                ]
            ],
        ]);
    }

    public function search(array $parameters)
    {
        return $this->elasticsearch->search($parameters);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->repo->index();

        return view('main', compact('books'));
    }
}
