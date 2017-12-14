<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiddleLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('middlelogistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->string('area');
            $table->string('city');
            $table->float('sendcount', 7, 2);
            $table->float('sendweight', 7, 2);
            $table->float('arriveweight', 7, 2);
            $table->float('arrivecount', 7, 2)->default(0);
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
        Schema::dropIfExists('middlelogistics');
    }
}
