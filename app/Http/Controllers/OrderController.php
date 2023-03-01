<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function orderList() {
        $order = Order::select('orders.*', 'users.name as user_name')
                ->when(request('key'), function($query) {
                    $query->where('orders.order_code', 'like', '%'.request('key').'%');
                })
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at','desc')
                ->paginate(5);
        // dd($order->toArray());
        return view('admin.order.list', compact('order'));
    }

    //sort with ajax
    public function changeStatus(Request $request) {
        // logger($request->all());
        // dd($request->all());

        $order = Order::select('orders.*', 'users.name as user_name')
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at','desc');

                if($request -> orderStatus == null) {
                    $order = $order -> paginate(5);

                } else {
                    $order = $order->where('orders.status', $request->orderStatus)-> paginate(5);
                }

                return view('admin.order.list', compact('order'));        
    }

    // ajax change status
    public function ajaxChangeStatus (Request $request) {
        logger($request -> all());
        Order::where('id', $request->orderId)->update([
            'status' => $request -> status
        ]);

        $order = Order::select('orders.*', 'users.name as user_name')
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at', 'desc')
                ->get();
        return response()->json($order, 200);        
    }
}
