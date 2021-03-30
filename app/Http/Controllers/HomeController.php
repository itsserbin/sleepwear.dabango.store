<?php

namespace App\Http\Controllers;

use App\Models\ProductsPhoto;
use App\Models\Products;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
