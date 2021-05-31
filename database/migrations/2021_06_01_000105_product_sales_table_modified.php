<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSalesTableModified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_days', function (Blueprint $table) {
            $table->string('canceled_orders_rate')->nullable();
            $table->string('received_parcel_ratio')->nullable();
            $table->string('сlient_cost')->nullable();
            $table->string('profit')->nullable();
            $table->string('marginality')->nullable();
            $table->string('investor_profit')->nullable();
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
