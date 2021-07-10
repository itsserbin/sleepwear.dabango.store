<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\OrderItemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
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

    public function getByOrderId($id)
    {
        $result = $this->OrderItemsRepository->getByOrderId($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Удаление элемента заказа по ID.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->OrderItemsRepository->destroy($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Обновить статус выплаты от поставщика
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePayStatus($id, Request $request)
    {
        $result = $this->OrderItemsRepository->updatePayStatus($id, $request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить элемент заказа для редактирования.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $result = $this->OrderItemsRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    public function update($id, Request $request)
    {
        $result = $this->OrderItemsRepository->update($id,$request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
