@extends('admin.layouts.master')
@section('title', 'Product Details Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">
        <div class="col-5 offset-4 mb-2">
            @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-circle-xmark text-lowercase"></i> {{session('updateSuccess')}}
                    <button type="button" class="close" data-dismiss="alert" >&times;</button>
                </div>   
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-12 col-md-10 offset-1">
                <div class="col-3 offset-10">
                    <a href=" {{route('product#list')}} "><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            {{-- <a href="product#list"> --}}
                                <i class="fa-solid fa-arrow-left text-black ml-3" onclick="history.back()"></i>
                            {{-- </a> --}}
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 offset-1">
                                <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm">
                            </div>
                            <div class="col-12 col-md-7 ">
                                <span class="my-3 btn btn-danger d-block w-50 fs-5"> <i class="fa-solid fa-user-pen mr-2"></i>  {{$pizza->name}} </span>

                                <span class="my-3 btn btn-dark"><i class="fa-solid fs-5 fa-money-bill-1-wave mr-2"></i> {{$pizza->price}} kyats</span>
                                <span class="my-3 btn btn-dark"><i class="fa-solid fs-5 fa-phone mr-2"></i> {{$pizza->waiting_time}} </span>
                                <span class="my-3 fs-5 btn btn-dark"><i class="fa-solid fa-mars-and-venus mr-2"></i> {{$pizza->view_count}} </span>
                                <span class="my-3 fs-5 btn btn-dark"><i class="fa-solid fa-user-clock mr-2"></i> {{$pizza->created_at->format('j-F-Y')}} </span>

                                <div class="my-3 "><i class="fa-solid fs-4 fa-file-lines mr-2"></i> {{$pizza->description}} </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 offset-1 mt-3">
                                <button class="btn bg-dark text-white">
                                    <div class="me-2">
                                        <i class="fa-solid fa-pen-to-square "></i>
                                        <a href="" class="text-white">
                                            Edit Product
                                        </a>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection