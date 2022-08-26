<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_menu_id')->unsigned();
            $table->string('category_order')->nullable();
            $table->integer('index')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->double('price_gofood')->nullable();
            $table->double('price_grabfood')->nullable();
            $table->string('additional_information')->nullable();
            $table->integer('discount')->default(0);
            $table->integer('discount_gofood')->default(0);
            $table->integer('discount_grabfood')->default(0);
            $table->integer('discount_takeaway')->default(0);
            $table->text('image')->nullable();
            $table->timestamps();
            
            $table->foreign('category_menu_id')->references('id')->on('category_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
