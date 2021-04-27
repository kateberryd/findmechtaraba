<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;
class VendorController extends Controller
{
    //
    public function index(){
        if(!Sentinel::forcecheck()){
            return redirect()->route('auth-login-v2');
            }else{
                $pageConfigs = ['pageHeader' => false];
                return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
            }
    }
    
    public function profile()
    {
        if(!Sentinel::forcecheck()){
            return redirect()->route('auth-login-v2');
            }else{
            $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Profile"]];
            $id = Sentinel::getUser()->id;
            $user = User::where('id', $id)->first();
            return view('/content/apps/vendor/profile', ['breadcrumbs' => $breadcrumbs, 'user' => $user]);
            }
        }
}
