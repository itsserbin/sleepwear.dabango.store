<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClientsRepository;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers\Api
 */
class AdminController extends BaseController
{
    private $ClientsRepository;
    private $OrdersRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ClientsRepository = app(ClientsRepository::class);
        $this->OrdersRepository = app(OrdersRepository::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboard()
    {
        $result = $this->ClientsRepository->getAllWithPaginate(15);
        $ordersToday = $this->OrdersRepository->countOrdersToday();

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
            'ordersToday' => $ordersToday,
        ]);
    }
}
