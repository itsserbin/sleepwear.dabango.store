<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ClientsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ClientsController
 * @package App\Http\Controllers\Api
 */
class ClientsController extends BaseController
{
    /** @var ClientsRepository  */
    private $ClientsRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ClientsRepository = app(ClientsRepository::class);
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $result = $this->ClientsRepository->getAllWithPaginate(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Поиск по клиентской базе.
     *
     * @param $search
     * @return JsonResponse
     */
    public function search($search)
    {
        $result = $this->ClientsRepository->search($search, 15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Удаление клиента.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->ClientsRepository->destroy($id);

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
        $result = $this->ClientsRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
