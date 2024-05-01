<?php

namespace App\Http\Controllers;

use ClickHouseDB;
use Illuminate\Support\Facades\DB;

class ControllerClick extends Controller
{
    public function __construct()
    {
        //$this->db = 
    }
    public function index()
    {
        $config = [
            'host' => 'clickhouse',
            'port' => '8123',
            //'port' => '8223',
            'username' => 'default',
            'password' => 'secret'
        ];
        $db = new ClickHouseDB\Client($config);
        $db->database('default');
        $db->setTimeout(1.5);      // 1500 ms
        $db->setTimeout(10);       // 10 seconds
        $db->setConnectTimeOut(5); // 5 seconds

        //$this->createDB($db);
        //$this->createServer1($db);

        /*
        $db->write("
        INSERT INTO default.replica_test(id,event_time)
        VALUES (2, '1994-08-22 01.01.01')
        ");*/

        $statement = $db->select('SELECT * FROM default.replica_test LIMIT 2');

        print_r($statement->rowsAsTree('WatchID'));
    }

    private function createServer1($db)
    {
        $this->createShard($db);
        //$this->createReplica($db);
        //$this->createDefault($db);
    }

    private function createShard($db)
    {
        $db->write(
            "
            CREATE TABLE default.test
            (
               id Int64,
               event_time DateTime
            )
            Engine=ReplicatedMergeTree('/clickhouse/tables/shard1/test', 'replica_1')
            PARTITION BY toYYYYMMDD(event_time)
            ORDER BY id;"
        );
    }

    //создание репликации
    private function createReplica($db)
    {
        $db->write(
            "
            CREATE TABLE default.replica_test
            (
              id Int64,
              event_time DateTime
            )
            Engine=ReplicatedMergeTree('/clickhouse/tables/shard2/test', 'replica_test')
            PARTITION BY toYYYYMMDD(event_time)
            ORDER BY id;"
        );
    }

    //создание распределенной таблицы
    private function createDefault($db)
    {
        $db->write(
            "
            CREATE TABLE default.test2
            (
               id Int64,
               event_time DateTime
            )
            ENGINE = Distributed('default', '', default.test, rand());"
        );
    }
}
