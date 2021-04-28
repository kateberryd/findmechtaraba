<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\User;
use Sentinel;
use Validator;

class AuthController extends Controller
{
  /**
   * Create user
   *
   * @param  [string] name
   * @param  [string] email
   * @param  [string] password
   * @param  [string] password_confirmation
   * @return [string] message
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|',
      'confirm_password' => 'required|same:password',
    ]);
    
    try{
      
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);
    
    $userRole = 'vendor';
    
    $notification = array(
      'message' => "Login and update your account",
      'success' => 'success'
    );		

    
    $role = Sentinel::findRoleBySlug($userRole);
    $role->users()->attach($user);

    if ($user->id) {
      return redirect()->route('auth-login-v2')->with($notification);;
    } else {
      return back()->withInput()->with('error', 'Could not create user. Try again!');

    }}
    catch (QueryException $e) {
        
      $error = array(
        'message' => "Account for $request->email already exists!",
        'error' => 'error'
      );

      $errorCode = $e->errorInfo[1];
      if($errorCode == 1062){
        return redirect()->back()->withInput()->with($error);
      }
    }
  }
  
  
  public function login_v2()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-login-v2', ['pageConfigs' => $pageConfigs]);
  }

  /**
   * Login user and create token
   *
   * @param  [string] email
   * @param  [string] password
   * @param  [boolean] remember_me
   * @return [string] access_token
   * @return [string] token_type
   * @return [string] expires_at
   */
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);
    
    $credentials = request(['email', 'password']);
    if (!Sentinel::forceauthenticate($credentials)){
      return redirect()->back()->with('error', 'Ops... Your Login Credentials did not match');
    }
    $user =   Sentinel::getUser();
    try {
      if (Sentinel::getUser()->roles()->first()->slug === 'admin') {						
          return redirect()->route('dashboard');                  
         }
      elseif (Sentinel::getUser()->roles()->first()->slug === 'vendor')  {
           return redirect()->route('dashboard');                          
        }
    }catch (\BadMethodCallException $e) {
      return redirect()->route('login.get')->with('error', 'Your Session has expired. Please login again!');
    }
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */
 

  /**
   * Get the authenticated User
   *
   * @return [json] user object
   */
  public function user(Request $request)
  {
    return response()->json($request->user());
  }
  
  public function account_settings()
  {
    if(!Sentinel::forcecheck()){
      return redirect()->route('auth-login-v2');
    }{
      $user = Sentinel::getUser();
      $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Account Settings"]];
      return view('/content/apps/vendor/account', ['breadcrumbs' => $breadcrumbs, 'user'=> $user]);
    }
    
  }
  


  
  public function updateAccount(Request $request){
    if(!Sentinel::forcecheck()){
      return redirect()->route('auth-login-v2');
    }else{
      $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
      $geoipInfo = geoip()->getLocation($ip);
      $ipData = $geoipInfo->toArray();
      $id = Sentinel::getUser()->id;
      $user = User::where('id', $id)->first();
      $imageName = time().'.'.$request->shop_image->extension();  
      $request->shop_image->move(public_path('uploads'), $imageName);
      $user->shop_image = $imageName;
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->phone_number = $request->phone_number;
      $user->company_name = $request->company_name;
      $user->company_address = $request->company_address;
      $user->state = $ipData['state_name'];
      $user->latitude = $ipData['lat'];
      $user->longitude = $ipData['lon'];
      $user->city = $ipData['city'];
      $user->country = $ipData['country'];
      $user->postal_code = $ipData['postal_code'];
      $user->ip = $ipData['ip'];
      $user->user_role = "vendor";
      $user->save();
      $notification = array(
        'message' => "Account updated successfully",
        'success' => 'success'
      );
      
      $error = array(
        'message' => "There was an error. Try agian",
        'error' => 'error'
      );			
      if($user->id){
        return redirect()->back()->with($notification);;
      }else{
        return redirect()->back()->with($error);;

      }
    }
   
  }
  
  public function logout(){
    if(!Sentinel::forcecheck()){
      return redirect()->route('auth-login-v2');
    }else{
      Sentinel::logout(null, true);
      return redirect()->route('auth-login-v2');
    }
  }
}
