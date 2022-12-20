<?php

namespace App\servises\Elastic;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\Formatter\ElasticsearchFormatter as BaseFormatter; 

class ElasticSearchFormatter extends BaseFormatter
{
    public function format(array $record)
    {
        $record = parent::format($record);

        if (isset($record['message']['tags'])) {
            $record['tags'] = $record['message']['tags'];
            unset($record['message']['tags']);
        }

        return $this->getDocument($record);
    }
}