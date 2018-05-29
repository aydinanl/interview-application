<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.profile', [
                'user' => $request->user
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function save(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if(isset($request->fullname)){
            $user->fullname = trim($request->fullname);
        }
        if(isset($request->email)){
            $user->email = trim($request->email);
        }
        if(isset($request->password)){
            $user->password = Hash::make(trim($request->password));
        }

        $user->save();
        return redirect('/admin/profile');
    }
}
