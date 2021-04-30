<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTableModified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('published')->default('0');
            $table->string('status')->change();

            $table->boolean('xs')->nullable();
            $table->boolean('s')->default('0')->change();
            $table->boolean('m')->default('0')->change();
            $table->boolean('l')->default('0')->change();
            $table->boolean('xl')->default('0')->change();
            $table->boolean('xxl')->default('0')->change();
            $table->boolean('xxxl')->default('0')->nullable();

            $table->string('title')->nullable()->change();
            $table->string('h1')->nullable()->change();


            $table->renameColumn('cost', 'price');
            $table->renameColumn('sale_cost', 'discount_price');

            $table->string('trade_price')->nullable();

            $table->string('vendor_code')->nullable();
            $table->string('preview')->nullable()->change();
            $table->string('total_sales')->nullable();
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
