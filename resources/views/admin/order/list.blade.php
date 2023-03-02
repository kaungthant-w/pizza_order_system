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


                <form action="{{route('admin#changeStatus')}}" method="get">
                    @csrf
                    <div class="input-group mb-3 col-6">
                        <label for="" class="mt-2 mr-2" for="orderLabel">Order Status</label>
                        <select name="orderStatus" id="orderLabel" class="custom-select col-3 orderStatus" id="orderStatus">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark input-group-text">Search</button>
                        </div>
                    </div>
                </form>
                
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
                                    <td >
                                        <a href="{{route('admin#listInfo', $o->order_code)}}" class="text-primary">{{$o->order_code}}</a>
                                    </td>
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
            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                }

                console.log($data);

                $.ajax({
                    type : 'get',
                    url : '/order/ajax/change/status',
                    data : $data,
                    dataType : 'json',
                })
            })
        })
    </script>
@endsection