<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateProductStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name','100');
            $table->string('detail','500');
            $table->integer('price');
            $table->string('img_url','200');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('stocks');
    }
}
