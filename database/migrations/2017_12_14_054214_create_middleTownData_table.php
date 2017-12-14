<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiddleTownDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('middletowndata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->string('town');
            $table->float('outputadd', 14, 4);
            $table->float('outputsame', 14, 4);
            $table->float('taxadd', 14, 4);
            $table->float('taxsame', 14, 4);
            $table->float('workeradd', 14, 4);
            $table->float('workersame', 14, 4);
            $table->float('poweradd', 14, 4);
            $table->float('powersame', 14, 4);
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
        Schema::dropIfExists('middletowndata');
    }
}
