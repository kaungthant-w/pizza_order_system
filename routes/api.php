<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting', function(){
    $data = [
        'message' => 'This is api testing message',
    ];
    return response()->json($data, 200);
});

Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']); // READ

//post
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']); // CREATE
// Route::post('delete/category', [RouteController::class, 'deleteCategory']);

//get
Route::get('category/delete/{id}', [RouteController::class, 'deleteCategory']); // DELETE
// Route::post('category/delete/{id}', [RouteController::class, 'deleteCategory']);

// Route::post('category/deails', [RouteController::class, 'categoryDetails']);
// Route::get('category/deails/{id}', [RouteController::class, 'categoryDetails']);
Route::get('category/list/{id}', [RouteController::class, 'categoryDetails']); //READ

Route::post('category/update', [RouteController::class, 'categoryUpdate']); // UPDATE



// product list
// http://127.0.0.1:8000/api/product/list (GET)

// category list 
// http://127.0.0.1:8000/api/category/list (GET)

// create category 
// http://127.0.0.1:8000/api/category/list (POST)



// http://127.0.0.1:8000/api/category/delete/{id} (GET)
// http://127.0.0.1:8000/api/category/list/{id} (GET)
// http://127.0.0.1:8000/api/category/update (POST)

// key => category_name, category_id