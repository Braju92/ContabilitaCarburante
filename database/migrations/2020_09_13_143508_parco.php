<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('parco')) {
            Schema::create('parco', function (Blueprint $table) {
                $table->string('Targa')->unique();
                $table->string('Reparto');
                $table->string('Tipo');
                $table->char('Alimentazione');
                $table->float('Consumo100Km');
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
        Schema::dropIfExists('parco');
    }
}
