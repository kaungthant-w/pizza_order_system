@extends('admin.layouts.master')
@section('title', 'Order List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
                        </div>
                    </div>

                </div>
                @if(session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between ">
                    <p>Search Key : <span class="text-danger"> {{request('key')}} </span></p>
                    <p> <i class="fa-solid fa-database"></i> ( <span class="text-danger"> {{$order->total()}}</span>)</p>

                    <form action=" {{route('admin#orderList')}}" class="w-25">
                        @csrf
                        <div  class="input-group">
                            <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}" >
                            <button class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

                <div class="d-flex mt-3">
                    <label for="" class="mt-2 mr-4">Order Status</label>
                    <select name="status" id="" class="form-control col-2 orderStatus" id="orderStatus">
                        <option value="">All</option>
                        <option value="0">Pending</option>
                        <option value="1">Accept</option>
                        <option value="2">Reject</option>
                    </select>
                </div>
                
                    {{-- @if (count($pizzas) != 0) --}}
                        <div class="table-responsive table-responsive-data2 mt-5">
                            <table class="table table-data2" id="dataList">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o )
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{$o->id}}">
                                        <td >{{$o->user_id}}</td>
                                        <td >{{$o->user_name}}</td>
                                        <td >{{$o->created_at->format('F-j-Y')}}</td>
                                        <td >{{$o->order_code}}</td>
                                        <td >{{$o->total_price}} Kyats</td>
                                        <td>
                                            <select name="status" class="form-control statusChange" id="statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    {{-- @else --}}
                    {{-- <p class="text-muted text-center mt-5">There is no Pizza Here...</p> --}}
                    {{-- @endif --}}
                <!-- END DATA TABLE -->
            </div>
            <div class="mt-3">
                {{ $order->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSection')
    <script>
        
        $(document).ready(function(){
            $('.orderStatus').change(function(){
                // console.log('hello')
                $status = $('.orderStatus').val();
                // console.log($status);

                $.ajax({
                    type : 'get', 
                    url : 'http://127.0.0.1:8000/order/ajax/status',
                    data :  {
                        'status' : $status,
                    },
                    dataType : 'json',
                    success : function (response) {
                        // console.log(response.data[0].created_at);
                        // console.log(response.data[0].user_name);
                        // console.log(response.data.length);
                        $list = '';
                            for($i=0; $i < response.data.length; $i++) {

                                // February-28-2023
                                // console.log(response.data[$i].created_at);
                                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September'];
                                $dbDate = new Date(response.data[$i].created_at);
                                // console.log($dbDate);
                                // console.log($dbDate.getMonth());
                                // console.log($dbDate.getDate());
                                // console.log($dbDate.getFullYear());
                                // console.log($months[$dbDate.getMonth()]);
                                // console.log($months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear());

                                $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

                                if(response.data[$i].status == 0) {
                                    $statusMessage = `
                                        <select name="status" class="form-control statusChange" id="statusChange">
                                            <option value="0" selected>Pending</option>
                                            <option value="1">Accept</option>
                                            <option value="2">Reject</option>
                                        </select>
                                    
                                    `;

                                } else if(response.data[$i].status == 1) {
                                    $statusMessage = `
                                        <select name="status" class="form-control statusChange" id="statusChange">
                                            <option value="0">Pending</option>
                                            <option value="1" selected>Accept</option>
                                            <option value="2">Reject</option>
                                        </select>
                                    
                                    `;

                                } else if(response.data[$i].status == 2) {
                                    $statusMessage = `
                                        <select name="status" class="form-control statusChange" id="statusChange">
                                            <option value="0">Pending</option>
                                            <option value="1">Accept</option>
                                            <option value="2" selected>Reject</option>
                                        </select>
                                    
                                    `;
                                }
                                
                                // console.log($statusMessage);

                                $list += `
                                    <tr class ="tr-shadow">
                                        <input type="hidden" class="orderId" value="${response.data[$i].id}">
                                        <td>${response.data[$i].user_id} </td>
                                        <td>${response.data[$i].user_name} || ${response.data[$i].id}  </td>
                                        <td>${$finalDate} </td>
                                        <td>${response.data[$i].order_code}</td>
                                        <td>${response.data[$i].total_price} kyats</td>
                                        <td>${$statusMessage}</td>
                                    </tr>
                                `;
                                }

                            $("#dataList").html($list);
                            // console.log($list);
                    }
                })
            })

            //change status
            $('.statusChange').change(function() {
                // $parentNode = $(this).parents('tr');
                // $price = Number($parentNode.find('#price').text().replace('kyats', ''));
                // $qty = Number($parentNode.find('#qty').val());
                // $total = $price * $qty;
                // $parentNode.find('#total').html(`${$total} kyats`);

                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                console.log($parentNode)
                $orderId = $parentNode.find('.orderId').val();

                console.log($orderId);

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                }

                // console.log($data);

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/order/ajax/change/status',
                    data : $data,
                    dataType : 'json',
                })

                // location.reload();
                // window.location.href = "http://127.0.0.1:8000/order/list";
            })
        })
    </script>
@endsection