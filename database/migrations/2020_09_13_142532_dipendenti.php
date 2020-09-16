<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dipendenti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('dipendenti')) {
            Schema::create('dipendenti', function (Blueprint $table) {
                $table->string('Nome');
                $table->string('Cognome');
                $table->string('Grado');
                $table->string('CIP')->unique();
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
        Schema::dropIfExists('dipendenti');
    }
}
