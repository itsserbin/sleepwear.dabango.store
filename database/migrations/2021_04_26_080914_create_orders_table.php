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
            $table->string('status');

            $table->string('name');
            $table->string('phone');

            $table->string('sizes')->nullable();
            $table->string('colors')->nullable();
            $table->string('city')->nullable();
            $table->string('nova_poshta')->nullable();
            $table->text('comment')->nullable();

            $table->foreignId('product_id')->nullable()->references('id')->on('products')->onDelete('set null');
            $table->foreignId('client_id')->nullable()->references('id')->on('clients')->onDelete('set null');

            $table->string('product_name');
            $table->string('trade_price');
            $table->string('sale_price');
            $table->string('profit');
            $table->string('pay')->default('0');

            $table->string('manager')->nullable();
            $table->string('modified_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
