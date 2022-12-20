<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ControllerPartition extends Controller
{
    public function index()
    {
        $this->select();

        /*
        DB::statement('
        CREATE TABLE measurement (
            city_id         int not null,
            logdate         date not null,
            peaktemp        int,
            unitsales       int
        ) PARTITION BY RANGE (logdate);
        ');*/
    }

    private function select()
    {
        $data = DB::select("SELECT * FROM measurement_y2006m01");
        dd($data);
    }

    private function createIndex()
    {
        DB::statement("
        CREATE INDEX ON measurement_y2006m01 (logdate)");

        DB::statement("
        CREATE INDEX ON measurement_y2006m02 (logdate)");
    }

    private function insert()
    {
        DB::insert(
            'insert into measurement (city_id, logdate, peaktemp, unitsales) 
                         values (:city_id, :logdate, :peaktemp, :unitsales)',
            [
                'city_id' => 2,
                'logdate' => '2021-10-01',
                'peaktemp' => 0,
                'unitsales' => 0
            ]
        );
    }

    private function makePartition()
    {
        DB::statement("
        CREATE TABLE measurement_y2006m01 PARTITION OF measurement
        FOR VALUES FROM ('2021-10-01') TO ('2021-11-01')");


        // PARTITION BY RANGE (peaktemp)

        DB::statement("
        CREATE TABLE measurement_y2006m02 PARTITION OF measurement
        FOR VALUES FROM ('2021-11-01') TO ('2021-12-01')
        ");
    }

    private function dropTable($table)
    {
        DB::statement("DROP TABLE $table");
    }

    private function detachPartition($table)
    {
        DB::statement("ALTER TABLE measurement DETACH PARTITION $table");
    }

    private function inherits()
    {
        DB::statement("CREATE TABLE measurement_y2006m02 (
            CHECK ( logdate >= DATE '2006-02-01' AND logdate < DATE '2006-03-01' )
        ) INHERITS (measurement)");
    }
    public function create()
    {
        DB::statement('
        CREATE TABLE measurement (
            city_id         int not null,
            logdate         date not null,
            peaktemp        int,
            unitsales       int
        )');
    }
}
