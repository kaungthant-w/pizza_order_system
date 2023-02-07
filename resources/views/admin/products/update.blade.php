@extends('admin.layouts.master')
@section('title', 'Products Update Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <a href="#">
                            <i class="fa-solid fa-arrow-left text-black ml-3" onclick="history.back()"></i>
                        </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Items</h3>
                        </div>
                        
                        <hr>

                        <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm">

                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
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
                                        <input name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter Name..."  value=" {{old('pizzaName', $pizza->name)}} ">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror" >{{old('pizzaDescription', $pizza->description)}}</textarea>

                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                                                       
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Pizza Category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif> {{$c->name}} </option>
                                                @endforeach
                                            </select>

                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" placeholder="Enter Price..." value="{{old('pizzaPrice', $pizza->price)}}">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" placeholder="Enter Waiting Time..." value="{{old('pizzaWaitingTime', $pizza->waiting_time)}}">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input name="viewCount" type="number" class="form-control @error('viewCount') is-invalid @enderror" placeholder="Enter View Count..." value="{{old('viewCount', $pizza->view_count)}}" disabled>
                                            @error('viewCount')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Date</label>
                                            <input name="created_at" type="text" disabled value="{{$pizza->created_at->format('j-F-Y')}}" class="form-control">
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