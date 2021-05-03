<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Mail\OrderShipped;
use App\Models\Colors;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductsColor;
use App\Models\ProductsPhoto;
use App\Models\Reviews;
use App\Models\Settings;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Clients;
use Illuminate\Support\Facades\Gate;
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
        $settings = Settings::find(1)->get();
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

        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(50);
        $reviews = Reviews::orderBy('created_at')->get();
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

            'settings' => $settings,
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }

    public function product($id)
    {
        $settings = Settings::find(1)->get();
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
        $ProductsColor = ProductsColor::where('product_id', '=', $id)->get();
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
            'ProductsColor' => $ProductsColor
        ]);
    }

    public function sendForm(Request $request)
    {
        $product = Products::where('id', $request->input('product_id'))->get();

        $name = $request->input('name');
        $sale_price = $request->input('sale_price');
        $colors = $request->input('colors');
        $sizes = $request->input('sizes');

        $phone = preg_replace('/[^0-9]/', '', $request->input('phone'));
        $phone = '+'.$phone;
        $check = Clients::where('phone', $phone)->get();

        foreach ($product as $product) {
            if (count($check)) {
                foreach ($check as $item) {
                    ++$item->number_of_purchases;
                    $item->whole_check = Orders::where('phone', $phone)->sum('sale_price') + $sale_price;
                    $item->average_check = $item->whole_check / $item->number_of_purchases;
                    $item->update();
                    $item->Orders()->create([
                        'name' => $name,
                        'phone' => $phone,
                        'status' => 'Новый',
                        'product_id' => $product->id,
                        'trade_price' => $product->trade_price,
                        'sale_price' => $sale_price,
                        'profit' => $sale_price - $product->trade_price,
                        'product_name' => $product->h1,
                        'colors' => $colors,
                        'sizes' => $sizes,
                    ]);
                }
            } else {
                $client = new Clients();
                $client->name = $name;
                $client->status = 'Новый';
                $client->phone = $phone;
                $client->number_of_purchases = 1;
                $client->whole_check = $sale_price;
                $client->average_check = $sale_price;

                $client->save();
                $client->Orders()->create([
                    'name' => $name,
                    'phone' => $phone,
                    'status' => 'Новый',
                    'product_id' => $product->id,
                    'trade_price' => $product->trade_price,
                    'sale_price' => $sale_price,
                    'profit' => $sale_price - $product->trade_price,
                    'product_name' => $product->h1,
                    'colors' => $colors,
                    'sizes' => $sizes,
                ]);
            }
            ++$product->total_sales;
            $product->update();
        }


        $name = $request->name;
        $phone = $request->phone;
        $sizes = $request->sizes;
        $url = $request->url;
        $product = $request->product;
        $product_name = $request->product_name;
        $colors = $request->colors;

        Mail::to(['serbin.ssd@gmail.com',
             'youbrand_top@ukr.net',
             'karina.youbrand@gmail.com'
        ])->send(new Order($name, $phone, $sizes, $url, $product_name, $product, $colors));

        $settings = Settings::find(1)->get();
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
        ]);
    }

    public function sendReview(Request $request)
    {
        $reviews = new Reviews();
        $data = $request->all();
        $reviews->create($data);
        return back()->with('success', 'Отзыв отправлен на модерацию');
    }
}
