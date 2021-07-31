<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Models\ProductsPhoto;
use App\Models\Reviews;
use App\Models\Options;
use App\Repositories\CategoriesRepository;
use App\Repositories\Products\ProductRepository;
use App\Services\OrderCheckout;
use App\Services\ShoppingCart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /** @var ProductRepository */
    private $ProductRepository;

    /** @var OrderCheckout */
    private $OrderCheckout;

    /** @var ShoppingCart */
    private $ShoppingCart;

    /** @var CategoriesRepository */
    private $CategoriesRepository;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(
        OrderCheckout $orderCheckout,
        ShoppingCart  $shoppingCart

    )
    {
        parent::__construct();
        $this->ProductRepository = app(ProductRepository::class);
        $this->CategoriesRepository = app(CategoriesRepository::class);
        $this->OrderCheckout = $orderCheckout;
        $this->ShoppingCart = $shoppingCart;
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

        $products = $this->ProductRepository->getItemsWithPaginateOnProduction(15);
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

        return view('pages.order.index', [
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

        return view('pages.checkout.index', [
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

    public function category($slug)
    {
        $settings = Options::find(1)->get();
        $cartCount = $this->cartCount();
        $category = $this->CategoriesRepository->findFySlug($slug);

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

        return view('pages.category.index', [
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
            'category' => $category
        ]);
    }

    /**
     * Открыть товарный фид для фейсбука.
     *
     * @return Response
     */
    public function fbProductFeed()
    {
        $products = $this->ProductRepository->getAll();

        return response()->view('xml.fb-product-feed', [
            'products' => $products
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Открыть товарный фид для prom.ua.
     *
     * @return Response
     */
    public function promProductFeed()
    {
        $products = $this->ProductRepository->getAll();
        $categories = $this->CategoriesRepository->getAllToFeed();

        return response()->view('xml.prom-product-feed', [
            'products' => $products,
            'categories' => $categories,
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Открыть карту сайта XML.
     *
     * @return Response
     */
    public function sitemap()
    {
        $products = $this->ProductRepository->getAll();
        $categories = $this->CategoriesRepository->getAllToFeed();

        return response()->view('xml.sitemap', [
            'products' => $products,
            'categories' => $categories,
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Открыть карту изображений XML.
     *
     * @return Response
     */
    public function imagesSitemap()
    {
        $products = $this->ProductRepository->getAll();

        return response()->view('xml.images-sitemap', [
            'products' => $products,
        ])->header('Content-Type', 'application/xml');
    }
    /**
     * Открыть политику конфеденциальности
     */
    public function privacyPolicy()
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

        return view('pages.privacy-policy',[
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

    /**
     * Открыть политику обмена и возврата.
     *
     * @return Application|Factory|View
     */
    public function exchangePolicy()
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

        return view('pages.exchange-policy',[
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

    /**
     * Открыть robots.txt
     *
     * @return Response
     */
    public function robots()
    {
        return response()->view('robots')->header('Content-Type', 'text/plain');
    }

    /**
     * Получить кол-во товаров в корзине.
     *
     * @return mixed
     */
    public function cartCount()
    {
        return $this->ShoppingCart->cartList()['totalCount'];
    }
}
