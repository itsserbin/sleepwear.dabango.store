<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostsController extends Controller
{
    public function index()
    {
        $costs = Costs::orderBy('created_at', 'desc')->paginate(15);
        $InJustAWeek = Costs::orderBy('created_at', 'desc')
            ->select('total')
            ->get(7)
            ->sum('total');

        return view('admin.bookkeeping.costs.index', [
            'costs' => $costs,
            'InJustAWeek' => $InJustAWeek
        ]);
    }

    public function create()
    {
        $cost = new Costs();

        return view('admin.bookkeeping.costs.create', [
            'cost' => $cost
        ]);
    }

    public function store(Request $request)
    {
        $cost = new Costs();
        $cost->name = $request->input('name');
        $cost->comment = $request->input('comment');
        $cost->quantity = $quantity = $request->input('quantity');
        $cost->sum = $sum = $request->input('sum');
        $cost->date = $request->input('date');
        $cost->user_id = Auth::id();
        $cost->total = $quantity * $sum;
        $cost->save();

        if ($cost) {
            return view('admin.bookkeeping.costs.edit', [
                'cost' => $cost
            ])->with('success', 'Трата успешно добавлена');
        } else {
            return back()->with('error', 'Произошла ошибка добавления');
        }
    }

    public function edit($id)
    {
        $cost = Costs::find($id);

        return view('admin.bookkeeping.costs.edit', [
            'cost' => $cost
        ]);
    }

    public function update($id, Request $request)
    {
        $cost = Costs::find($id);
        $cost->name = $request->input('name');
        $cost->comment = $request->input('comment');
        $cost->quantity = $quantity = $request->input('quantity');
        $cost->sum = $sum = $request->input('sum');
        $cost->total = $quantity * $sum;
        $cost->date = $request->input('date');
        $cost->update();

        if ($cost) {
            return view('admin.bookkeeping.costs.edit',[
                'cost' => $cost
            ])->with('success', 'Трата успешно обновлена');
        } else {
            return view('admin.bookkeeping.costs.edit')->with('error', 'Произошла ошибка обновления');
        }
    }

    public function destroy($id)
    {
        $cost = Costs::destroy($id);

        if ($cost) {
            return back()->with('success', 'Трата успешно удалена');
        } else {
            return back()->with('error', 'Произошла ошибка удаления');
        }
    }
}
