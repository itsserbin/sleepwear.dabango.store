<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfitsTableModified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profits', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->string('cost')->nullable()->change();
            $table->string('cost')->nullable()->change();
            $table->string('profit')->nullable()->change();
            $table->string('marginality')->nullable()->change();
            $table->string('turnover')->nullable()->change();
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
