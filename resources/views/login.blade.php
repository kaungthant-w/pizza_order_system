@extends('layouts.master')
@section('title','Login Page')
@section("content")
    <div class="login-form">
            @error('terms')
                <p class="text-danger">{{$message}}</p>
            @enderror
        <form action=" {{route('login')}} " method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group m-t-20">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            
            <button class="au-btn au-btn--block au-btn--green m-t-20 m-b-20" type="submit">sign in</button>
            
        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection