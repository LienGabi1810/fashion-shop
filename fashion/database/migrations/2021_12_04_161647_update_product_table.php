<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->integer('price')->nullable()->change();
            $table->integer('status')->nullable()->change();
            $table->integer('quantity')->nullable()->change();
            $table->integer('is_hightlight')->nullable()->change();
            $table->integer('category_id')->nullable()->change();
            $table->string('weight')->nullable()->change();
            $table->string('imensions')->nullable()->change();
            $table->string('materials')->nullable()->change();
            $table->string('color')->nullable()->change();
            $table->string('sizes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
