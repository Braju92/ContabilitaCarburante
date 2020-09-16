<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Utilizzocedola extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('utilizzocedola')) {
            Schema::create('utilizzocedola', function (Blueprint $table) {
                $table->integer('IDRifornimento');
                $table->integer('IDCedola');
                $table->float('Consumo');
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
        Schema::dropIfExists('utilizzocedola');
    }
}
