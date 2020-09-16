<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rifornimenti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('rifornimento')) {
            Schema::create('rifornimenti', function (Blueprint $table) {
                $table->integer('IDRifornimento')->unique();
                $table->string('Targa');
                $table->float('RifornimentoLitri');
                $table->string('Conduttore');
                $table->date('Data');
                $table->float('EuroLitro');
                $table->boolean('Cisterna');
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
        Schema::dropIfExists('rifornimenti');
    }
}
