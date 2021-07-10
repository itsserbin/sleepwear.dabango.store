<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Http\Request;

class CartController extends Controller
{
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
        return view('pages.cart.index',[
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
}
