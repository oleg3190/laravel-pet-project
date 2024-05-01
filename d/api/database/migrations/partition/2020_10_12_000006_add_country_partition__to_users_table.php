<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCountryPartitionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get distinct countries from your existing users data
        $countries = DB::table('users')->distinct()->pluck('country')->toArray();

        // Create partitioned table based on 'country'
        $partitionSql = 'ALTER TABLE users PARTITION BY LIST (country) (';

        $str = '';
        foreach ($countries as $country) {
            // Escape the country name
            $country = addslashes($country);
            $country = strtolower($country);
            $country = str_replace(' ', '_', $country);
            $country = str_replace('-', '_', $country);
            $country = str_replace('(', '_', $country);
            $country = str_replace(')', '_', $country);
            $str .= "PARTITION p_$country VALUES IN ('$country'),";
        }

        DB::statement("
        ALTER TABLE users
        PARTITION BY LIST (country) (
            $str
            PARTITION p_other VALUES IN (DEFAULT)
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop partitioning
        DB::statement('ALTER TABLE users REMOVE PARTITIONING');

    }
}