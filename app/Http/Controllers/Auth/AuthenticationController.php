<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller {
     public function showLogin() {
      if(Auth::check()) {
        return redirect()->route("home.dashboard.view");
     }

          return view("auth.login");
     }
     
     public function login(Request $request) {
  
    

        $validate = $request->validate([
         'email'=>['required'],
         'password'=>['required' , 'min:8']
        ]);

        if(Auth::attempt($validate)){
           return redirect()->route("home.dashboard.view");
        } 

        return back()->withErrors(['message'=> 'sign in failed! please try again']);
     }

     public function showRegister() {
      if(Auth::check()) {
        return redirect()->route("home.dashboard.view");
     }
     
      return view("auth.register");
     }

     public function register(Request $request) {
   

        $validate = $request->validate([
          'name'=>['required'],
          'phone_number'=>['required'],
          'fullname'=>['required'],
          'email'=>['required' , 'unique:users'],
          'password'=>['required' , 'min:8'],
          'confirm'=>['required','same:password' , 'min:8']
        ]);

        $created = User::create([
          'name'=>$request->name,
          'phone_number'=>$request->phone_number,
          'fullname'=>$request->fullname, 
          'email'=>$request->email, 
          'password'=>Hash::make($request->password)
        ]);

        if($created) {
          return redirect()->route("home.dashboard.view");
        }

        return back()->withErrors(['message' => 'failed to create account!']);
     }

     public function logout() {
          Auth::logout();

          return redirect()->route("auth.login.view");
     }
}