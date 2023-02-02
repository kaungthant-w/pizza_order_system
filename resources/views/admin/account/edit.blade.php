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
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        
                        <hr>

                        <form action="">
                            <div class="row">
                                <div class=" col-4 offset-1">
                                    @if(Auth::user()->image == null)
                                    <img src=" {{asset('img/default_user.png')}} " class="img-thumbnail shadow-sm">
                                    @else
                                        <img src=" {{asset('admin/images/icon/avatar-01.jpg')}} ">  
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-circle-chevron-right mr-2"></i>Update</button>
                                    </div>
                                </div>

                                <div class="row col-6 ">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name..." value="{{old('name', Auth::user()->name)}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email..." value="{{old('email', Auth::user()->email)}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="number" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone..." value="{{old('phone', Auth::user()->phone)}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control" id="" cols="30" rows="10" placeholder="Enter Admin Address...">{{old('address', Auth::user()->address)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input name="role" type="text" aria-required="true" aria-invalid="false" placeholder="Enter Admin Role..." value="{{old('role', Auth::user()->role)}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection