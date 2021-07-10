<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierPaymentsController extends Controller
{
    public function index()
    {
        return view('admin.bookkeeping.supplier-payments.index');
    }
}
