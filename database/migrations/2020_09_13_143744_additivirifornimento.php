<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Additivirifornimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('additivirifornimento')) {
            Schema::create('additivirifornimento', function (Blueprint $table) {
                $table->integer('IDRifornimento');
                $table->string('TipoAdditivi');
                $table->float('LitriAdditivi');
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
        Schema::dropIfExists('additivirifornimento');
    }
}
