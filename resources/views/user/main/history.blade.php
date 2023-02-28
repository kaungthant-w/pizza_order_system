@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height:400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o )
                            <tr>
                                <td class="align-middle"> {{$o->created_at->format('F-j-Y')}} </td>
                                <td class="align-middle"> {{$o->order_code}} </td>
                                <td class="align-middle"> {{$o->total_price}} </td>
                                <td class="align-middle"> 
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i class="fa-regular fa-clock mr-2"></i> pending...</span>
                                    @elseif ($o->status == 1)    
                                        <span class="text-success"><i class="fa-solid fa-check mr-2"></i> success</span>
                                    @elseif ($o->status == 2)    
                                    <span class="text-danger"><i class="fa-solid fa-triangle-exclamation mr-2"></i> reject</span>    
                                    @endif    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')

@endsection