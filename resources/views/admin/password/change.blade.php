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
                            <h3 class="text-center title-2">Create Your Category</h3>
                        </div>
                        <hr>
                        <form action=" {{route('admin#changePassword')}} " method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Old Password</label>
                                <input name="oldPassword" type="password" aria-required="true" aria-invalid="false" placeholder="Enter Old Password..." value="{{old('oldPassword')}}" class="form-control @if(session('notMatch')) is-invalid  @endif @error('oldPassword') is-invalid @enderror">

                                @error('oldPassword')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (session('notMatch'))
                                    <div class="invalid-feedback">
                                        {{session('notMatch')}}
                                    </div>
                                    
                                @endif
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