@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <a href=" {{route('admin#list')}} ">
                            <i class="fa-solid fa-arrow-left text-black ml-3"></i>
                        </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        
                        <hr>

                        <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-4 offset-1">
                                    @if($account->image == null)
                                        @if ($account->gender == 'male')
                                            <img src="{{asset('img/default_user.png')}}" alt="" class="img-thumbnail">
                                        @else
                                            <img src="{{asset('img/female_default.png')}}" alt="" class="img-thumbnail">    
                                        @endif 
                                    @else
                                        <img src="{{asset('storage/'.$account->image)}}" alt="" class="img-thumbnail"> 
                                    @endif

                                    <div class="mt-3">
                                        <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-circle-chevron-right mr-2"></i>Change</button>
                                    </div>
                                </div>

                                <div class="row col-6 ">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Admin Name..." value="{{old('name', $account->name)}}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <select name="role" class="form-control">
                                            <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email..." value="{{old('email', $account->email)}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone..." value="{{old('phone', $account->phone)}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="" disabled>
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if($account->gender=='male') selected @endif>Male</option>
                                                <option value="female" @if($account->gender=='female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter Admin Address..." disabled>{{old('address', $account->address)}}</textarea>
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