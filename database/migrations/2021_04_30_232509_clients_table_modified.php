<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientsTableModified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('phone')->change();
            $table->string('city')->nullable();
            $table->dropColumn('product');
            $table->dropColumn('size');

            $table->string('number_of_purchases')->nullable();
            $table->string('whole_check')->nullable();
            $table->string('average_check')->nullable();
            $table->string('status')->change();
            $table->string('modified_by')->nullable();
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
