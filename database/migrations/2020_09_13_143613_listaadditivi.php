<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Listaadditivi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('listaadditivi')) {
            Schema::create('listaadditivi', function (Blueprint $table) {
                $table->string('CodiceAdditivo')->unique();
                $table->string('TipoAdditivo');
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
        Schema::dropIfExists('listaadditivi');
    }
}
