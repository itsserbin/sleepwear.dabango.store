<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\User;
use App\Repositories\OptionsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class OptionsController extends Controller
{
    private $OptionsRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->OptionsRepository = app(OptionsRepository::class);
    }

    /**
     * Получить основные настройки.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $options = $this->OptionsRepository->getIndex();

        return view('admin.options.index', [
            'options' => $options
        ]);
    }

    /**
     * Получить скрипты.
     *
     * @return Application|Factory|View
     */
    public function scripts()
    {
        $options = $this->OptionsRepository->getScripts();

        return view('admin.options.scripts.index', [
            'options' => $options
        ]);
    }

    /**
     * Обновить настройки.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->OptionsRepository->update($request);

        return back()->with('success', 'Настройки успешно обновлены!');
    }
}
