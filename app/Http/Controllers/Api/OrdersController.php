<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderCreateRequest;
use App\Repositories\OrdersRepository;
use App\Services\OrderCheckout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OrdersController
 * @package App\Http\Controllers\Api
 */
class OrdersController extends BaseController
{
    /** @var OrdersRepository */
    private $OrdersRepository;

    /** @var OrderCheckout */
    private $OrderCheckout;

    /**
     * ClientsController constructor.
     */
    public function __construct(OrderCheckout $orderCheckout)
    {
        parent::__construct();
        $this->OrdersRepository = app(OrdersRepository::class);
        $this->OrderCheckout = $orderCheckout;
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

    public function create(OrderCreateRequest $orderCreateRequest)
    {
        $this->OrderCheckout->createOrder($orderCreateRequest->all());

        return $this->returnResponse([
            'success' => true
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

    /**
     * Удаление заказа.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->OrdersRepository->destroy($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить клиента по ID для редактирования.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $result = $this->OrdersRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Обновление информации заказа по ID.
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        $result = $this->OrdersRepository->update($id, $request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
