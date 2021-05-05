<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('application_price')->nullable();
            $table->string('unprocessed')->nullable();
            $table->string('advertising')->nullable();
            $table->string('applications')->nullable();
            $table->string('completed_applications')->nullable();
            $table->string('refunds')->nullable();
            $table->string('cancel')->nullable();
            $table->string('at_the_post_office')->nullable();
            $table->string('in_process')->nullable();
            $table->string('price_per_application')->nullable();
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
        Schema::dropIfExists('orders_days');
    }
}
