@extends('user.layouts.master')
@section('title', 'Home Page')
@section('content')
    
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge badge-info font-weight-normal"> {{count($category)}} </span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href=" {{route("user#home")}}" class="text-dark"><label class="" for="price-1"> All </label></a>
                        </div>
                        @foreach ($category as $c )
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href=" {{route('user#filter', $c->id)}} " class="text-dark"><label class="" for="price-1"> {{$c->name}}</label></a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Size Start -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">

                                    <select name="sorting" id="sortingOption" class="custom-select">
                                        <option value="">Choose Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <a href="detail.html"> --}}
                        <div class="row " id="dataList">
                            @if (count($pizza) != 0)
                                @foreach ($pizza as $p)
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4" id="myForm">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height:18rem" src="{{asset('storage/'.$p->image)}}" alt="">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>{{$p->price}} kyats</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center h2 shadow-sm m-5">There is no pizza <i class="fa-solid fa-pizza-slice"></i></p>
                            @endif
                        </div>    
                    {{-- </a> --}}

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section("scriptSource")
    <script>
        $(document).ready(function(){
            // alert("hello jquery");
            // $.ajax({
            //     type: 'get',
            //     url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
            //     dataType: 'json',
            //     success : function(response) {
            //         console.log(response);
            //     }
            // })

            // $sortingOption = $('#sortingOption').val();
            // console.log($sortingOption);

            $('#sortingOption').change(function(){
                // console.log('this is changing');
                $eventOption = $("#sortingOption").val();
                // console.log($eventOption);

                if($eventOption == "asc") {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data : {
                            'status':'asc',
                            'message':'This is testing message',
                        },
                        dataType: 'json',
                        success : function(response) {

                            $list = '';
                            for($i=0; $i < response.length; $i++) {
                                // console.log(response[i].name);
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:18rem" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            // console.log(response);
                            // console.log(response[0].name);
                            // console.log($list);

                            $("#dataList").html($list);

                        }
                    })
                } else if($eventOption == 'desc') {
                    // console.log('last in first out');
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data : {'status':'desc'},
                        dataType: 'json',
                        success : function(response) {
                            // console.log(response);

                            $list = '';
                            for($i=0; $i < response.length; $i++) {
                                // console.log(response[i].name);
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:18rem" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $("#dataList").html($list);
                        }
                    })
                }
            });
            
        });
    </script>
@endsection