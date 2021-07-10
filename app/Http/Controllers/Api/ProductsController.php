<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Products\ProductColorsRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $ProductRepository;
    private $ProductColorsRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ProductRepository = app(ProductRepository::class);
        $this->ProductColorsRepository = app(ProductColorsRepository::class);
    }

    public function index()
    {
        $result = $this->ProductRepository->getAllWithPaginate(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Показать товар по ID.
     *
     * @param $id
     * @return JsonResponse
     */
    public function showProductApi($id)
    {
        $result = $this->ProductRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Показать цвета по ID товара.
     *
     * @param $id
     * @return JsonResponse
     */
    public function showProductColorsApi($id)
    {
        $result = $this->ProductColorsRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
