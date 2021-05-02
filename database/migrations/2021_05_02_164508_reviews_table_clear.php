<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReviewsTableClear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //select reviews.id
        //from reviews
        //    left join products on reviews.product_id = products.id
        //where products.id is null
        // сперва селектим айдишки
        $result = DB::table('reviews')
            ->select('reviews.id')
            ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
            ->whereNull('products.id')
            ->get();


        // а потом или дропаем из или присваем существующий продукт
        foreach ($result as $item) {
            DB::table('reviews')
                // подумай что лучше удалить или перезаписать)
                ->where('id', $item->id)
                ->delete();
        }
        // и только потом форейн
        // как то так)
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
