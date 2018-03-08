<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTagsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tags = [
            [
                'name'      =>  'laravel'
            ],
            [
                'name'      =>  'thinkphp'
            ],
            [
                'name'      =>  'php'
            ],
            [
                'name'      =>  'nodejs'
            ],
            [
                'name'      =>  'vue'
            ]
        ];

        DB::table('tags')->insert($tags);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tags')->truncate();
    }
}
