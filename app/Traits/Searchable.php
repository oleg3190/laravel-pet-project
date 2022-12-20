<?php

namespace App\Traits;

use App\servises\Elastic\ElasticsearchObserver;

trait Searchable
{
    public static function bootSearchable()
    {
        static::observe(ElasticsearchObserver::class);
    }
}
