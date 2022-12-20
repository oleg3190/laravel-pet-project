<?php

namespace App\Providers;

use App\Contracts\BooksRepository;
use App\Contracts\SearchBookRepository;
use App\repo\BookRepository;
use App\repo\ElasticsearchBookRepository;
use Illuminate\Support\ServiceProvider;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SearchBookRepository::class,
            ElasticsearchBookRepository::class
        );
        $this->app->bind(
            BooksRepository::class,
            BookRepository::class
        );
        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts([$app['config']->get('services.search.hosts')])
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false ]))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
