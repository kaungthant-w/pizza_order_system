<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AjaxController extends Controller
{
    // return pizza list
    public function pizzaList(Request $request) {
        logger($request->all());
        // logger($request->status);

        if($request->status == 'desc') {
            $pizza = Product::orderBy('created_at', 'desc')->get();
        } else {
            $pizza = Product::orderBy('created_at', 'asc')->get();
        }
        // $data = Product::get();
        return response()->json($pizza, 200);
    }

    // return add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        // logger($data);

        Cart::create($data);
        $response = [
            'message' => 'Add To cart Complete',
            'status' => 'success'
        ];

        return response()->json($response, 200);

        
    }


    // get order data
    private function getOrderData($request) {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
        ];
    }
}
