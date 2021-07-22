<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Mail\OrderShipped;
use App\Models\ProductsPhoto;
use App\Models\Reviews;
use App\Models\Options;
use App\Repositories\Products\ProductRepository;
use App\Services\OrderCheckout;
use App\Services\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /** @var ProductRepository */
    private $ProductRepository;

    /** @var OrderCheckout  */
    private $OrderCheckout;

    /** @var ShoppingCart */
    private $ShoppingCart;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(
        OrderCheckout $orderCheckout,
        ShoppingCart $shoppingCart

    )
    {
        parent::__construct();
        $this->ProductRepository = app(ProductRepository::class);
        $this->OrderCheckout = $orderCheckout;
        $this->ShoppingCart = $shoppingCart;
    }

    public function cartCount()
    {
        return $this->ShoppingCart->cartList()['totalCount'];
    }
    public function index()
    {
        $settings = Options::find(1)->get();
        foreach ($settings as $setting) {
            $phone = $setting->phone;
            $email = $setting->email;
            $facebook = $setting->facebook;
            $instagram = $setting->instagram;
            $schedule = $setting->schedule;
            $telegram = $setting->telegram;
            $viber = $setting->viber;
            $head_scripts = $setting->head_scripts;
            $after_body_scripts = $setting->after_body_scripts;
            $footer_scripts = $setting->footer_scripts;
        }

        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(100);
        $reviews = Reviews::orderBy('created_at')->get();
        $cartCount = $this->cartCount();

        return view('pages.home.index', [
            'phone' => $phone,
            'email' => $email,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'schedule' => $schedule,
            'telegram' => $telegram,
            'viber' => $viber,
            'head_scripts' => $head_scripts,
            'after_body_scripts' => $after_body_scripts,
            'footer_scripts' => $footer_scripts,

            'options' => $settings,
            'products' => $products,
            'reviews' => $reviews,
            'cartCount' => $cartCount,
        ]);
    }

    public function product($id)
    {
        $settings = Options::find(1)->get();
        foreach ($settings as $setting) {
            $phone = $setting->phone;
            $email = $setting->email;
            $facebook = $setting->facebook;
            $instagram = $setting->instagram;
            $schedule = $setting->schedule;
            $telegram = $setting->telegram;
            $viber = $setting->viber;
            $head_scripts = $setting->head_scripts;
            $after_body_scripts = $setting->after_body_scripts;
            $footer_scripts = $setting->footer_scripts;
        }

        $product = $this->ProductRepository->getProduct($id);
        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(30);
        $productsPhoto = ProductsPhoto::where('product_id', '=', $id)->get();
        $cartCount = $this->cartCount();

        return view('pages.product.index', [
            'phone' => $phone,
            'email' => $email,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'schedule' => $schedule,
            'telegram' => $telegram,
            'viber' => $viber,
            'head_scripts' => $head_scripts,
            'after_body_scripts' => $after_body_scripts,
            'footer_scripts' => $footer_scripts,

            'product' => $product,
            'productsPhoto' => $productsPhoto,
            'products' => $products,
            'cartCount' => $cartCount,

        ]);
    }

//    public function send_form_post(OrderCreateRequest $orderCreateRequest)
//    {
////        $this->CreateOrder->newOrder($request->all());
//        $this->OrderCheckout->createOrder($orderCreateRequest->all());
////        $product = Products::where('id', $request->input('product_id'))->get();
////
////        $name = $request->input('name');
////        $sale_price = $request->input('sale_price');
////        $colors = $request->input('colors');
////        $sizes = $request->input('sizes');
////
////        $phone = preg_replace('/[^0-9]/', '', $request->input('phone'));
////        $phone = '+'.$phone;
////        $check = Clients::where('phone', $phone)->get();
////
////        foreach ($product as $product) {
////            if (count($check)) {
////                foreach ($check as $item) {
////                    ++$item->number_of_purchases;
////                    $item->whole_check = Orders::where('phone', $phone)->sum('sale_price') + $sale_price;
////                    $item->average_check = $item->whole_check / $item->number_of_purchases;
////                    $item->update();
////                    $item->Orders()->create([
////                        'name' => $name,
////                        'phone' => $phone,
////                        'status' => 'Новый',
////                        'product_id' => $product->id,
////                        'trade_price' => $product->trade_price,
////                        'sale_price' => $sale_price,
////                        'profit' => $sale_price - $product->trade_price,
////                        'product_name' => $product->h1,
////                        'colors' => $colors,
////                        'sizes' => $sizes,
////                    ]);
////                }
////            } else {
////                $client = new Clients();
////
////                $client->name = $name;
////                $client->status = 'Новый';
////                $client->phone = $phone;
////                $client->number_of_purchases = 1;
////                $client->whole_check = $sale_price;
////                $client->average_check = $sale_price;
////                $client->save();
////                $client->Orders()->create([
////                    'name' => $name,
////                    'phone' => $phone,
////                    'status' => 'Новый',
////                    'product_id' => $product->id,
////                    'trade_price' => $product->trade_price,
////                    'sale_price' => $sale_price,
////                    'profit' => $sale_price - $product->trade_price,
////                    'product_name' => $product->h1,
////                    'colors' => $colors,
////                    'sizes' => $sizes,
////                ]);
////            }
////            ++$product->total_sales;
////            $product->update();
////        }
////
////        $name = $request->name;
////        $phone = $request->phone;
////        $sizes = $request->sizes;
////        $url = $request->url;
////        $product = $request->product_id;
////        $product_name = $request->product_name;
////        $colors = $request->colors;
////
////        Mail::to(['serbin.ssd@gmail.com',
////            'youbrand_top@ukr.net',
////            'karina.youbrand@gmail.com'
////        ])->send(new Order($name, $phone, $sizes, $url, $product_name, $product, $colors));
//
//    }

    public function send_form_get()
    {
        $settings = Options::find(1)->get();
        $cartCount = $this->cartCount();

        foreach ($settings as $setting) {
            $phone = $setting->phone;
            $email = $setting->email;
            $facebook = $setting->facebook;
            $instagram = $setting->instagram;
            $schedule = $setting->schedule;
            $telegram = $setting->telegram;
            $viber = $setting->viber;
            $head_scripts = $setting->head_scripts;
            $after_body_scripts = $setting->after_body_scripts;
            $footer_scripts = $setting->footer_scripts;
        }

        return view('pages.order.index',[
            'phone' => $phone,
            'email' => $email,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'schedule' => $schedule,
            'telegram' => $telegram,
            'viber' => $viber,
            'head_scripts' => $head_scripts,
            'after_body_scripts' => $after_body_scripts,
            'footer_scripts' => $footer_scripts,
            'cartCount' => $cartCount,
        ]);
    }

    public function send_review_post(ReviewCreateRequest $reviewCreateRequest)
    {
        $reviews = new Reviews();
        $data = $reviewCreateRequest->all();
        $reviews->create($data);
    }

    public function checkout()
    {
        $settings = Options::find(1)->get();
        $cartCount = $this->cartCount();

        foreach ($settings as $setting) {
            $phone = $setting->phone;
            $email = $setting->email;
            $facebook = $setting->facebook;
            $instagram = $setting->instagram;
            $schedule = $setting->schedule;
            $telegram = $setting->telegram;
            $viber = $setting->viber;
            $head_scripts = $setting->head_scripts;
            $after_body_scripts = $setting->after_body_scripts;
            $footer_scripts = $setting->footer_scripts;
        }

        return view('pages.checkout.index',[
            'phone' => $phone,
            'email' => $email,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'schedule' => $schedule,
            'telegram' => $telegram,
            'viber' => $viber,
            'head_scripts' => $head_scripts,
            'after_body_scripts' => $after_body_scripts,
            'footer_scripts' => $footer_scripts,
            'cartCount' => $cartCount,
        ]);
    }

    public function category()
    {
        $settings = Options::find(1)->get();
        $cartCount = $this->cartCount();

        foreach ($settings as $setting) {
            $phone = $setting->phone;
            $email = $setting->email;
            $facebook = $setting->facebook;
            $instagram = $setting->instagram;
            $schedule = $setting->schedule;
            $telegram = $setting->telegram;
            $viber = $setting->viber;
            $head_scripts = $setting->head_scripts;
            $after_body_scripts = $setting->after_body_scripts;
            $footer_scripts = $setting->footer_scripts;
        }

        return view('pages.category.index',[
            'phone' => $phone,
            'email' => $email,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'schedule' => $schedule,
            'telegram' => $telegram,
            'viber' => $viber,
            'head_scripts' => $head_scripts,
            'after_body_scripts' => $after_body_scripts,
            'footer_scripts' => $footer_scripts,
            'cartCount' => $cartCount,
        ]);
    }
}
