<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\OrdersRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class OrdersController
 * @package App\Http\Controllers\Admin
 */
class OrdersController extends Controller
{
    private $OrdersRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->OrdersRepository = app(OrdersRepository::class);
    }

    /**
     * Получить все заказы и вывести в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = $this->OrdersRepository->getAllWithPaginate(15);

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Получить заказ для редактирования.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $order = $this->OrdersRepository->getById($id);

        return view('admin.orders.edit', [
            'order' => $order
        ]);
    }

    /**
     * Обновить данные заказа.
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->OrdersRepository->update($id, $request->except('_method', '_token'));

        return back()->with('success', 'Заказ успешно обновлен!');
    }

    /**
     * Удалить заказ.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->OrdersRepository->destroy($id);

        return back()->with('success', 'Заказ успешно удален!');
    }

    /**
     * Вывести новые заказы в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showNewOrders()
    {
        $orders = $this->OrdersRepository->getNewOrdersWithPaginate(15);

        return view('admin.orders.new.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Вывести заказы в процессе в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showProcessOrders()
    {
        $orders = $this->OrdersRepository->getProcessOrdersWithPaginate(15);

        return view('admin.orders.process.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Вывести заказы переданные поставщику в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showTransferredToSupplierOrders()
    {
        $orders = $this->OrdersRepository->getTransferredToSupplierOrdersWithPaginate(15);

        return view('admin.orders.transferred-to-supplier.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Вывести заказы на почте в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showPostOfficeOrders()
    {
        $orders = $this->OrdersRepository->getPostOfficeOrdersWithPaginate(15);

        return view('admin.orders.post-office-clients.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Вывести выполненные заказы в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showDoneOrders()
    {
        $orders = $this->OrdersRepository->getDoneOrdersWithPaginate(15);

        return view('admin.orders.done.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Вывести возвращеные заказы в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showReturnOrders()
    {
        $orders = $this->OrdersRepository->getReturnOrdersWithPaginate(15);

        return view('admin.orders.return.index', [
            'orders' => $orders,
        ]);
    }


    /**
     * Вывести отмененные заказы в пагинацию по 15 шт.
     *
     * @return Application|Factory|View
     */
    public function showCancelOrders()
    {
        $orders = $this->OrdersRepository->getCancelOrdersWithPaginate(15);

        return view('admin.orders.cancel.index', [
            'orders' => $orders,
        ]);
    }

    public function getAllPhones()
    {
        $phones = $this->OrdersRepository->getAllPhones();

        return view('admin.orders.phones', [
            'phones' => $phones
        ]);
    }

}
