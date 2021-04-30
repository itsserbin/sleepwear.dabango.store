<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::find(1);
        if ($settings) {
            $settings = Settings::find(1)->select(
                'schedule',
                'email',
                'phone',
                'facebook',
                'instagram',
                'telegram',
                'viber',
                'whatsapp',
                'fb_messenger')->get();
        } else {
            $settings = new Settings();
            $settings->save();
        }
        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function scripts()
    {
        $settings = Settings::find(1);
        if ($settings) {
            $settings = Settings::find(1)->select(
                'head_scripts',
                'after_body_scripts',
                'footer_scripts')->get();

        } else {
            $settings = new Settings();

        }
        return view('admin.settings.scripts.index', [
            'settings' => $settings
        ]);
    }

    public function show()
    {
        //
    }

    public function save(Request $request)
    {

        $settings = Settings::find(1);
        $data = $request->all();

        if ($settings) {
            $settings->update($data);
        } else {
            $settings = (new Settings())->create($data);
        }


        return back();
    }
}
