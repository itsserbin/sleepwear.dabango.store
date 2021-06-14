<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Products;
use App\Repositories\ClientsRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClientsController
 * @package App\Http\Controllers\Admin
 */
class ClientsController extends Controller
{
    private $ClientRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->ClientRepository = app(ClientsRepository::class);
    }

    /**
     * Вывести всех клиентов в пагинации по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $clients = $this->ClientRepository->getAllWithPaginate(15);
        return view('admin.clients.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Получить клиента по ID.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $client = $this->ClientRepository->getById($id);

        return view('admin.clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Обновить данные клиента.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->ClientRepository->update($id,$request->all());

        return back()->with('success', 'Информация успешно сохранена');
    }

    /**
     * Удалить клиента из базы.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->ClientRepository->destroy($id);

        return back()->with('success', 'Информация успешно удалена');
    }
}
