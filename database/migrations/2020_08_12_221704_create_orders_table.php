<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_date_id')->unsigned();
            $table->bigInteger('table_id')->nullable()->unsigned();
            $table->string('order_category')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('discount_order')->nullable()->default(0);
            $table->bigInteger('total_payment')->nullable();
            $table->string('pembayaran')->nullable();
            $table->string('order_status');
            $table->timestamps();
            
            $table->foreign('order_date_id')->references('id')->on('order_dates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
