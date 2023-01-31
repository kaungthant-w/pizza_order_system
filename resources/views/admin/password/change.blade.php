@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href=" {{route('category#list')}} "><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        @if(session('changeSuccess'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check mr-2"></i> {{ session('changeSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>                   
                        @endif
                        @if(session('notMatch'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('notMatch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>                   
                        @endif
                        <hr>
                        <form action=" {{route('admin#changePassword')}} " method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Old Password</label>
                                <input name="oldPassword" type="password" aria-required="true" aria-invalid="false" placeholder="Enter Old Password..." value="{{old('oldPassword')}}" class="form-control @error('oldPassword') is-invalid @enderror">
                                
                                @error('oldPassword"')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">New Password</label>
                                <input name="newPassword" type="password" aria-required="true" aria-invalid="false" placeholder="Enter New Password..." value="{{old('newPassword')}}" class="form-control @error('newPassword') is-invalid @enderror">

                                @error('newPassword')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Confirm Password</label>
                                <input name="confirmPassword" type="password" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password..." value="{{old('confirmPassword')}}" class="form-control @error('confirmPassword') is-invalid @enderror">

                                @error('confirmPassword')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key mr-2"></i>
                                    <span id="payment-button-amount">Change Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection