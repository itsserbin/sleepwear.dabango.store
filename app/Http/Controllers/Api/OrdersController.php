<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;

/**
 * Class OrdersController
 * @package App\Http\Controllers\Api
 */
class OrdersController extends BaseController
{
    private $OrdersRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->OrdersRepository = app(OrdersRepository::class);
    }

    /**
     * Вывести все заказы в пагинацию по 15 шт.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->OrdersRepository->getAllWithPaginate(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Поиск заказа в базе.
     *
     * @param $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($search)
    {
        $result = $this->OrdersRepository->search($search, 15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    public function destroy($id)
    {
        $result = $this->OrdersRepository->destroy($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
