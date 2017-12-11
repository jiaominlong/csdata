<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignCsIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreigncsindexs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->float('dingji', 10, 6);
            $table->float('huanbi', 10, 6);
            $table->float('tongbi', 10, 6);
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
        Schema::dropIfExists('foreigncsindexs');
    }
}
