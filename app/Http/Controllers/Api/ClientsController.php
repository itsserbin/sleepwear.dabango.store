<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ClientsRepository;
use Illuminate\Http\Request;

/**
 * Class ClientsController
 * @package App\Http\Controllers\Api
 */
class ClientsController extends BaseController
{
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->ClientsRepository->destroy($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
