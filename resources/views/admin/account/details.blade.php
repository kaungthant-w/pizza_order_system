@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="col-3 offset-1">
                                @if(Auth::user()->mage == null) 
                                    <img src="{{asset('img/default_user.png')}}">
                                @else
                                    <img src=" {{asset('admin/images/icon/avatar-01.jpg')}}">
                                @endif
                            </div>
                            <div class="col-12 col-md-7 offset-1 ">
                                <h4 class="my-3"> <i class="fa-solid fa-user-pen mr-2"></i>  {{Auth::user()->name}} </h4>
                                <h4 class="my-3"><i class="fa-solid fa-envelope mr-2"></i> {{Auth::user()->email}} </h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone mr-2"></i> {{Auth::user()->phone}} </h4>
                                <h4 class="my-3"><i class="fa-solid fa-location-dot mr-2"></i> {{Auth::user()->address}} </h4>
                                <h4 class="my-3"><i class="fa-solid fa-user-clock mr-2"></i> {{Auth::user()->created_at->format('j-F-Y')}} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 offset-1 mt-3">
                                <button class="btn bg-dark text-white">
                                    <div class="fa-solid fa-pen-to-square me-2">
                                        <a href=" {{route('admin#edit')}} ">
                                            Edit Profile
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