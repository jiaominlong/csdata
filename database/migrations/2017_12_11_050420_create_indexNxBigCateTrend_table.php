<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexNxBigCateTrendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        http://blog.csdn.net/u283056051/article/details/52463948
        Schema::create('indexnxbigcatetrend', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->string('category');
            $table->float('index', 10, 5);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indexnxbigcatetrend');
    }
}
