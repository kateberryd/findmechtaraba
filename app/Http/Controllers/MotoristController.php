<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
use App\User;
use DB;

class MotoristController extends Controller
{
    
    //
    
    public function dashboard(){
        if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
          }else{
              $pageConfigs = ['pageHeader' => false];
              return view('/content/apps/motorist/dashboard', ['pageConfigs' => $pageConfigs]);
          }
      }
    
      public function account(){
        if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
          }else{
              $pageConfigs = ['pageHeader' => false];
              $id = Sentinel::getUser()->id;
             $user = User::where('id', $id)->first();
              return view('/content/apps/motorist/account', ['pageConfigs' => $pageConfigs, 'user' => $user]);
          }
      }
      
      public function profile(){
        if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
          }else{
              $pageConfigs = ['pageHeader' => false];
              $id = Sentinel::getUser()->id;
              $user = User::where('id', $id)->first();
              return view('/content/apps/motorist/profile', ['pageConfigs' => $pageConfigs, 'user'=> $user]);
          }
      }
      
      public function vendor(){
        if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
          }else{
              $pageConfigs = ['pageHeader' => false];
              return view('/content/apps/motorist/dashboard', ['pageConfigs' => $pageConfigs]);
          }
      }
      
      public function updateMotoristAccount(Request $request){
        if(!Sentinel::forcecheck()){
          return redirect()->route('auth-login-v2');
        }else{
          $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
          $geoipInfo = geoip()->getLocation($ip);
          $ipData = $geoipInfo->toArray();
          $id =   Sentinel::getUser()->id;
          $user = User::where('id', $id)->first();
          $user->first_name = $request->first_name;
          $user->last_name = $request->last_name;
          $user->phone_number = $request->phone_number;
          $user->company_address = $request->company_address;
          $user->state = $ipData['state_name'];
          $user->latitude = $ipData['lat'];
          $user->longitude = $ipData['lon'];
          $user->city = $ipData['city'];
          $user->country = $ipData['country'];
          $user->postal_code = $ipData['postal_code'];
          $user->ip = $ipData['ip'];
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
      
  public function findMechanic(Request $request){
    $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
    $geoipInfo = geoip()->getLocation($ip);
    $ipData = $geoipInfo->toArray();
    
    $lat       =       $ipData['lat'];
    $lon      =       $ipData['lon'];

    $vendors = DB::table("users")
    ->select("*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->groupBy("users.id");
    $vendors  =  $vendors->having('distance', '<', 20);
    $vendors          =    $vendors->orderBy('distance', 'asc');
    $vendors   = $vendors->get();
    return view('/content/apps/motorist/mechanic')->with('vendors', $vendors);
     }
  
  public function viewMap(Request $request, $id){
    $vendor = User::where('id', $id)->first();
    return view('/content/apps/motorist/map')->with('vendor', $vendor);

  }
    
}
