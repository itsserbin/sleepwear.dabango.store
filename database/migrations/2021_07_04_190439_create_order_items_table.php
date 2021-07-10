<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('order_id');
            $table->integer('product_id');

            $table->foreignId('provider_id')
                ->nullable()
                ->references('id')
                ->on('providers')
                ->onDelete('set null');

            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->integer('trade_price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('profit')->nullable();
            $table->boolean('pay')->nullable();
            $table->integer('count')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
