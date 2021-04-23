<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Mail\OrderShipped;
use App\Models\ProductsColor;
use App\Models\ProductsPhoto;
use App\Models\Reviews;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Clients;
use Illuminate\Support\Facades\Mail;

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
        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(30);
        $reviews = Reviews::orderBy('created_at')->get();
        return view('pages.home.index',[
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }

    public function product($id)
    {
        $product = $this->ProductRepository->getProduct($id);
        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(30);
        $productsPhoto = ProductsPhoto::where('product_id', '=', $id)->get();
        $ProductsColor = ProductsColor::where('product_id', '=', $id)->get();

        return view('pages.product.index',[
            'product' => $product,
            'productsPhoto' => $productsPhoto,
            'products' => $products,
            'ProductsColor' => $ProductsColor
        ]);
    }

    public function sendForm(Request $request)
    {
        $client = new Clients();
        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->product = $request->input('product');
        $client->size = $request->input('size');
        $client->status = $request->input('status');

        $client->save();

        $name = $request->name;
        $phone = $request->phone;
        $size = $request->size;
        $url = $request->url;
        $product = $request->product;
        $product_name = $request->product_name;

         Mail::to([
             'serbin.ssd@gmail.com',
             'youbrand_top@ukr.net',
             'karina.youbrand@gmail.com'
         ])->send(new Order($name, $phone, $size, $url, $product_name, $product));

        return view('pages.order.index');
    }

    public function sendReview(Request $request)
    {
        $reviews = new Reviews();
        $data = $request->all();
        $reviews->create($data);
        return back()->with('success', 'Отзыв отправлен на модерацию');
    }
}
