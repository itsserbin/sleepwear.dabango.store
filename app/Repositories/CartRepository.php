<?php

namespace App\Repositories;

use App\Models\Cart as Model;

/**
 * Class CartRepository
 * @package App\Repositories
 */
class CartRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function find($uuid)
    {
        return $this->model::where('hash', $uuid)->first();
    }

    public function create($uuid)
    {
        $cart = new $this->model;
        $cart->hash = $uuid;

        $cart->save();

        return $cart;
    }

    public function update($data, $uuid)
    {
        //
    }

    public function destroy($uuid)
    {
        return $this->model::where('hash', $uuid)->delete();
    }
}
