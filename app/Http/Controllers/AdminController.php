<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Sentinel;

class AdminController extends Controller
{
    //
    public function dashboard(){
      if(!Sentinel::forcecheck()){
        return redirect()->route('auth-login-v2');
        }else{
            $pageConfigs = ['pageHeader' => false];
            $vendor = User::where('user_role', 'vendor');
            $motorist = User::where('user_role', 'user');
            return view('/content/dashboard/index', ['pageConfigs' => $pageConfigs, 'motorist' => $motorist, 'vendor' => $vendor]);
        }
    }
    
    public function index(){
        if(!Sentinel::forcecheck()){
            return redirect()->route('auth-login-v2');
          }{
        $pageConfigs = ['pageHeader' => false];
        return view('/content/apps/user/app-user-list', ['pageConfigs' => $pageConfigs]);
          }
    }
    
    public function users(){
        $users = User::all();
        return response()->json(['data' => $users,]);
    }
    
    public function user(){
      if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
        }{
        $pageConfigs = ['pageHeader' => false];
        $users = User::all();
      return view('/content/apps/user/app-user-view', ['pageConfigs' => $pageConfigs, 'users'=>$users]);
        }
  }
}
