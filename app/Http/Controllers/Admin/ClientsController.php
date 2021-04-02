<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Products;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    private $ClientRepository;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->ClientRepository = app(ClientRepository::class);
    }


    public function index()
    {
        $clients = $this->ClientRepository->getAllWithPaginate(15);
        return view('admin.clients.index', [
            'clients' => $clients,
        ]);
    }

    public function edit($id)
    {
        $client = Clients::find($id);

        return view('admin.clients.edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Clients::find($id);
        $data = $request->all();
        $client->update($data);

        return back()->with('success', 'Информация успешно сохранена');
    }

    public function destroy($id)
    {
        Clients::destroy($id);

        return back()->with('success', 'Информация успешно удалена');
    }
}
