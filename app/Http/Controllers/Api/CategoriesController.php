<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateCategoryRequest;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CategoriesController
 * @package App\Http\Controllers\Api
 */
class CategoriesController extends BaseController
{
    /** @var CategoriesRepository */
    private $CategoriesRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->CategoriesRepository = app(CategoriesRepository::class);
    }

    /**
     * Показать все категории в пагинации.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $result = $this->CategoriesRepository->getAllWithPaginate(15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить все категории.
     *
     * @return JsonResponse
     */
    public function all()
    {
        $result = $this->CategoriesRepository->getAll();

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Создать новую категорию.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $result = $this->CategoriesRepository->create($request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить категорию для редактирования.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $result = $this->CategoriesRepository->getById($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Обновить информацию о категориях.
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        $result = $this->CategoriesRepository->update($id, $request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить категории для вывода на прод.
     *
     * @return JsonResponse
     */
    public function getAllOnProd()
    {
        $result = $this->CategoriesRepository->getAllOnProd();

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Удалить категорию.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->CategoriesRepository->destroy($id);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить категорию по Slug для вывода на продакшн.
     *
     * @param $slug
     * @return JsonResponse
     */
    public function getCategoryOnProduction($slug)
    {
        $result = $this->CategoriesRepository->getCategoryOnProduction($slug);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Получить товары из категории по Slug для вывода на продакшн.
     *
     * @param $slug
     * @return JsonResponse
     */
    public function getCategoryProductsOnProduction($slug)
    {
        $result = $this->CategoriesRepository->getCategoryProductsOnProduction($slug, 15);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }
}
