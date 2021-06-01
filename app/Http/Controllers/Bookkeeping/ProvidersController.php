<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Providers;
use App\Repositories\Bookkeeping\ProvidersRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ProvidersController
 * @package App\Http\Controllers\Bookkeeping
 */
class ProvidersController extends Controller
{
    private $ProvidersRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->ProvidersRepository = app(ProvidersRepository::class);
    }

    /**
     * Вывести всех поставщиков в пагинации по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $providers = $this->ProvidersRepository->getAllWithPaginate(15);

        return view('admin.bookkeeping.providers.index', [
            'providers' => $providers,
        ]);
    }

    /**
     * Показать страницу создания поставщика.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $provider = new Providers();

        return view('admin.bookkeeping.providers.create', [
            'provider' => $provider
        ]);
    }

    /**
     * Создание нового поставщика.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $provider = $this->ProvidersRepository->create($request->except('_token', '_method'));

        return view('admin.bookkeeping.providers.edit', [
            'provider' => $provider,
        ])->with('success', 'Поставщик успешно создан!');
    }

    /**
     * Получить поставщика по ID для редактирования.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $provider = $this->ProvidersRepository->getById($id);

        return view('admin.bookkeeping.providers.edit', [
            'provider' => $provider
        ]);
    }

    /**
     * Обновить данные поставщика.
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->ProvidersRepository->update($id, $request->except('_method', '_token'));

        return back()->with('success', 'Поставщик успешно обновлен!');
    }

    /**
     * Удаление поставщика.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->ProvidersRepository->destroy($id);

        return back()->with('success', 'Поставщик успешно удален!');
    }
}
