<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightDimensionsMaterialsColorSizesToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('weight');
            $table->string('imensions');
            $table->string('materials');
            $table->string('color');
            $table->string('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('weight');
            $table->string('imensions');
            $table->string('materials');
            $table->string('color');
            $table->string('sizes');
        });
    }
}
