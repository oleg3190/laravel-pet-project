<?php

namespace App\Providers;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\ElasticsearchFormatter;

/**
 * Class ElkServiceProvider
 *
 * @package App\Providers
 */
class ElkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            $url = $this->getHost();

            return ClientBuilder::create()->setHosts([$url])->build();
        });

        $this->app->bind(ElasticsearchFormatter::class, function ($app) {
            return new ElasticsearchFormatter($this->getIndexName(), $this->getIndexType());
        });
    }

    /**
     * Текущее окружение
     *
     * @return string
     */
    protected function getEnvironmentName(): string
    {
        return env('APP_ENV', 'production');
    }

    /**
     * Тип индекса
     *
     * @return string
     */
    public function getIndexType(): string
    {
        $env = $this->getEnvironmentName();

        return config(sprintf('elk.%s.type', $env));
    }

    /**
     * Имя индекса
     *
     * @return string
     */
    public function getIndexName(): string
    {
        $env = $this->getEnvironmentName();

        return config(sprintf('elk.%s.index', $env));
    }

    /**
     * Хост
     *
     * @return string
     */
    public function getHost(): string
    {
        $env = $this->getEnvironmentName();

        $schema = config(sprintf('elk.%s.schema', $env));
        $domain = config(sprintf('elk.%s.domain', $env));
        $port   = config(sprintf('elk.%s.port', $env));

        return $this->buildUrl($schema, $domain, $port);
    }

    /**
     * Сформировать путь к elk
     *
     * @param string $schema
     * @param string $domain
     * @param string $port
     *
     * @return string
     */
    protected function buildUrl(string $schema, string $domain, string $port): string
    {
        return sprintf('%s://%s:%s', $schema, $domain, $port);
    }
}