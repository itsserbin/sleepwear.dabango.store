<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClientsOldUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $result = DB::table('clients')
            ->select('id','phone')
            ->get();


        // а потом или дропаем из или присваем существующий продукт
        foreach ($result as $item) {
            $phone = preg_replace('/[^0-9]/', '', $item->phone);
            $phone = '+'.$phone;
            DB::table('clients')->where('id',$item->id)->update(['phone' => $phone]);
        }
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
