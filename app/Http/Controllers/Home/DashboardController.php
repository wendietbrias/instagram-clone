<?php 

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//models
use App\Models\Posts;
use App\Models\User;


class DashboardController extends Controller {
    public function showDashboard() {
       if(!Auth::check()){
        return redirect()->route("auth.login.view");
       }

       $allPosts = Posts::with(['user'])->get();

       return view("home.dashboard" , [
        "posts"=>$allPosts,
        "id"=>Auth::id()
       ]);
    }

    public function showCreate() {
        if(!Auth::check()) {
            return redirect()->route("auth.login.view");
        }
        
        return view('home.create', ["title"=>'Create']);
    }
}