<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexNxPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexnxprice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->integer('times');
            $table->string('category');
            $table->float('zengsu', 10, 5);
            $table->float('huanbi', 10, 5);
            $table->float('dingji', 10, 5);
            $table->float('tongbi', 10, 5);
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
        Schema::dropIfExists('indexnxprice');
    }
}
