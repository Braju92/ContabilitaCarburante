<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tipocedole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tipocedole')) {
            Schema::create('tipocedole', function (Blueprint $table) {
                $table->integer('IDGruppo')->unique();
                $table->char('Carburante');
                $table->string('Ente');
                $table->float('Prezzo');
                $table->integer('Numero');
                $table->float('Taglio');
                $table->date('DataAcquisizione');
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
        Schema::dropIfExists('tipocedole');
    }
}
