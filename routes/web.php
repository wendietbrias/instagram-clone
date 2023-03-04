<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Home\DashboardController;
use App\Http\Controllers\Home\PostsController;
use App\Http\Controllers\Home\ProfileController;


//auth prefix and views

Route::group(['prefix'=>'auth'] , function($router) {

    Route::get("/" , [AuthenticationController::class,'showLogin'])->name('auth.login.view');
    Route::post("/" , [AuthenticationController::class, 'login'])->name('auth.login');
    Route::get("register", [AuthenticationController::class,'showRegister'])->name('auth.register.view');
    Route::post("register" , [AuthenticationController::class, 'register'])->name('auth.register');
    Route::post("logout" , [AuthenticationController::class,  'logout'])->name('auth.logout');
});

//home views

Route::group(['prefix'=>'/'] ,function($router) {
    //dashboard home root
    Route::get('/' , [DashboardController::class, 'showDashboard'])->name('home.dashboard.view');
    Route::get("create" , [DashboardController::class, 'showCreate'])->name('home.create.view');

});

//profile views 

Route::group(['prefix'=>'/profile'] , function($router) {
    Route::get("/" , [ProfileController::class, 'showProfile'])->name('home.profile.view');
    Route::post("/" , [ProfileController::class,  "update"])->name("home.profile.update");
    Route::post("/update/avatar" , [ProfileController::class, 'updateAvatar'])->name("home.avatar.update");
});

//ajax prefix

Route::group(['prefix'=>'/ajax'], function($router) {
    Route::get("/all" , [PostsController::class, "getAllPosts"])->name("allPosts");
    Route::post("create" , [PostsController::class, 'create'])->name('home.create');
    Route::delete('delete/{id}' , [PostsController::class, 'delete'])->name('home.delete');
    Route::post('update/{id}' , [PostsController::class, 'delete'])->name('home.update');

    Route::post("like", [PostsController::class, 'like'])->name('home.like');
});
