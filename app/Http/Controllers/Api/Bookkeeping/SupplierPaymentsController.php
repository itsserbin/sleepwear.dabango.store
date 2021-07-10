<?php

namespace App\Http\Controllers\Api\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Repositories\OrderItemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierPaymentsController extends Controller
{
    /** @var OrderItemsRepository */
    private $OrderItemsRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->OrderItemsRepository = app(OrderItemsRepository::class);
    }

    /**
     * Получить все заказы
     *
     * @return JsonResponse
     */
    public function index()
    {
        $result = $this->OrderItemsRepository->allPayments(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить все заказы, ожидающие выплаты от поставщика.
     *
     * @return JsonResponse
     */
    public function paymentsAwaiting()
    {
        $result = $this->OrderItemsRepository->PaymentsAwaiting(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить все заказы, с полученной выплатой.
     *
     * @return JsonResponse
     */
    public function paymentsReceived()
    {
        $result = $this->OrderItemsRepository->paymentsReceived(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
