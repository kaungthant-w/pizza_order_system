@extends('admin.layouts.master')
@section('title', 'Product List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2 mt-5">
                    <a href="{{route('admin#orderList')}}" class="text-dark"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

                    <div class="card mt-4 col-6">
                        <div class="card-body">
                            <h3>Order Info</h3>
                            <div class="text-warning mb-4 border-bottom"> <i class="fa-solid fa-triangle-exclamation text-sm"></i> Include Delivery Charges</div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user mr-2"></i> Customer Name</div>
                                <div class="col"> {{strtoupper($orderList[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode mr-2"></i> Order Code</div>
                                <div class="col"> {{$orderList[0]->order_code}}</div>
                            </div>
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-clock mr-2"></i> Order Date</div>
                                <div class="col"> {{$orderList[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-money-bill-wave mr-2 "></i> Total</div>
                                <div class="col"> {{$order->total_price}} Kyats</div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2" id="dataList">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o )
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td>{{$o->user_id}}</td>
                                    <td> <img src="{{asset('storage/'.$o->product_image)}}" alt="" class="img-thumbnail" style="width:100px;height:100px"> </td>
                                    <td>{{$o->product_name}}</td>
                                    <td>{{$o->created_at->format('F-j-Y')}}</td>
                                    <td>{{$o->qty}}</td>
                                    <td>{{$o->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection