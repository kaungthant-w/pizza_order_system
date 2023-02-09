@extends('user.layouts.master')
@section('title', 'Account Change Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        
                        <hr>

                        <form action=" {{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-4 offset-1">
                                    @if(Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{asset('img/default_user.png')}}" alt="" class="img-thumbnail">
                                        @else
                                            <img src="{{asset('img/female_default.png')}}" alt="" class="img-thumbnail">    
                                        @endif 
                                    @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="" class="img-thumbnail"> 
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" >
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-circle-chevron-right mr-2"></i>Update</button>
                                    </div>
                                </div>

                                <div class="row col-6 ">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Admin Name..." value="{{old('name', Auth::user()->name)}}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email..." value="{{old('email', Auth::user()->email)}}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone..." value="{{old('phone', Auth::user()->phone)}}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if(Auth::user()->gender=='male') selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender=='female') selected @endif>Female</option>
                                            </select>

                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter Admin Address...">{{old('address', Auth::user()->address)}}</textarea>

                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
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