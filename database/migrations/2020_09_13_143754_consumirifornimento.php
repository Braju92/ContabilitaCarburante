<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consumirifornimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('consumirifornimento')) {
            Schema::create('consumirifornimento', function (Blueprint $table) {
                $table->date('Data');
                $table->string('Targa');
                $table->integer('KmAttuali');
                $table->integer('Step');
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
        Schema::dropIfExists('consumirifornimento');
    }
}
