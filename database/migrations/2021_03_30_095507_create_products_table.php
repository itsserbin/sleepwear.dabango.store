<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('h1')->nullable();
            $table->text('content')->nullable();
            $table->text('characteristics')->nullable();
            $table->text('cost')->nullable();
            $table->text('sale_cost')->nullable();
            $table->text('preview')->nullable();
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
        Schema::dropIfExists('products');
    }
}
