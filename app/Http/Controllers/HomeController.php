<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\ProductsPhoto;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Clients;

class HomeController extends Controller
{
    private $ProductRepository;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->ProductRepository = app(ProductRepository::class);
    }

    public function index()
    {
        $products = $this->ProductRepository->getAllWithPaginate();
        return view('pages.home.index',[
            'products' => $products
        ]);
    }

    public function product($id)
    {
        $product = $this->ProductRepository->getProduct($id);
        $products = $this->ProductRepository->getAllWithPaginate(20);
        $productsPhoto = ProductsPhoto::where('product_id', '=', $id)->get();
        return view('pages.product.index',[
            'product' => $product,
            'productsPhoto' => $productsPhoto,
            'products' => $products
        ]);
    }

    public function send_form(Request $request)
    {
        $client = new Clients();
        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->product = $request->input('product');
        $client->size = $request->input('size');
        $client->status = $request->input('status');

        $client->save();

//        $name = $request->name;
//        $phone = $request->phone;
//        $size = $request->size;
//
//        Mail::to('serbin.ssd@gmail.com')->send(new Order($name, $phone, $size));

        return back();
    }

}
