<?php


namespace App\Models;

use PhpClickHouseLaravel\BaseModel;

class Clickhouse extends BaseModel
{
    // Not necessary. Can be obtained from class name MyTable => my_table
    protected $table = 'clickhouse';
}
