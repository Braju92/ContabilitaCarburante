<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Depositocisterna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('depositocisterna')) {
            Schema::create('depositocisterna', function (Blueprint $table) {
                $table->date('Data')->unique();
                $table->integer('LitriBenzinaRimanenti');
                $table->integer('LitriBenzinaConsumati')->nullable();
                $table->integer('LitriBenzinaImmessi')->nullable();
                $table->integer('LitriGasolioRimanenti');
                $table->integer('LitriGasolioConsumati')->nullable();
                $table->integer('LitriGasolioImmessi')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositocisterna');
    }
}
