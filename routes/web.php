<?php

// use auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

// Route::get('/', function () {
//     return view('login');
// });

// Route::get("/register", function() {
//     return view("register");
// });


// login , register 
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {
    // category 
    Route::group(['prefix' => 'category'], function() {
    Route::get('list', [CategoryController::class, 'list'])->name('category#list');
});
});

// admin



// user