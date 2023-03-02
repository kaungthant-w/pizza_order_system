@extends('user.layouts.master')
@section('title', 'Home Page')
@section('content')
    
    <div class="container-fluid">
        <div class="col-6 offset-3 px-xl-5 my-5">
            @if(session('successContact'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('successContact') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            <h3 class="mb-4">Contact Form</h3>

            <form action="{{route('user#createContact')}}" method="post" >
               @csrf 
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">

                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your email">
                    @error('email')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                    @error('message')
                        <small class="text-danger"> {{$message}} </small>
                    @enderror
                </div>

                <input type="submit" value="Send" class="btn btn-dark mt-3">

            </form>

        </div>
    </div>
@endsection