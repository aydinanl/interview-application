<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingCtrl extends Controller
{
    public function index(Request $request)
    {
        $settings = Settings::all()->first();
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.settings', [
                'user' => $request->user,
                'settings' => $settings
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function save(Request $request)
    {
        $setting = new Settings;

        $settings = Settings::all()->first();
        if(isset($settings)){
            $setting = $settings;
        }

        //Site Settings
        if(isset($request->site_title)){
            $setting->site_title = ucwords(trim($request->site_title));
        }
        if(isset($request->site_desc)){
            $setting->site_desc = trim($request->site_desc);
        }
        if(isset($request->site_keywords)){
            $setting->site_keywords = trim($request->site_keywords);
        }

        //Contact Information
        if(isset($request->contact_address)){
            $setting->contact_address = strtoupper(trim($request->contact_address));
        }
        if(isset($request->contact_map)){
            $setting->contact_map = strtolower(trim($request->contact_map));
        }
        if(isset($request->contact_cep)){
            $setting->contact_cep = trim($request->contact_cep);
        }
        if(isset($request->contact_sabit)){
            $setting->contact_sabit = trim($request->contact_sabit);
        }

        //Contact Branch Information
        if(isset($request->contact_branch_address)){
            $setting->contact_branch_address = strtoupper(trim($request->contact_branch_address));
        }
        if(isset($request->contact_branch_cep)){
            $setting->contact_branch_cep = trim($request->contact_branch_cep);
        }
        if(isset($request->contact_branch_sabit)){
            $setting->contact_branch_sabit = trim($request->contact_branch_sabit);
        }

        //Social Media Information
        if(isset($request->facebook)){
            $setting->facebook = trim($request->facebook);
        }
        if(isset($request->twitter)){
            $setting->twitter = trim($request->twitter);
        }
        if(isset($request->instagram)){
            $setting->instagram = trim($request->instagram);
        }
        $setting->save();

        return redirect('/admin/settings');
    }
}
