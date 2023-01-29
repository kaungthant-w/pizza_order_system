<?php

// use auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;


// login , register 
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {

    // dashboard 
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // admin
    // category 
    Route::group(['prefix' => 'category', 'middleware'=> 'admin_auth'], function() {
    Route::get('list', [CategoryController::class, 'list'])->name('category#list');
    Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
    Route::post('create', [CategoryController::class, 'create'])->name('category#create');
});

    // user
    // home
    Route::group(['prefix' => 'user', 'middle'=>'user_auth'], function() {
        Route::get('home', function() {
            return view('user.home');
        })->name("user#home");
    });

});
