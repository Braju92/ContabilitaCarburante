<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cedole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cedole')) {
            Schema::create('cedole', function (Blueprint $table) {
                $table->integer('IDCedola')->unique();
                $table->string('TipoCedola');
                $table->float('ImportoRimanente');
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
        Schema::dropIfExists('cedole');
    }
}
