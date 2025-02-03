@extends('layouts.main')
@section('content')
<form class="login_form_container" action="{{ route('login') }}" method="POST">
    @csrf
    @if ($errors->any())
        @foreach ($errors->all() as $error )
        <div class="first_error">
            {{$error}}
        </div>
        @endforeach
    @endif
    <div class="login_form_container_title">LOGIN</div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com" value="{{old('email')}}">
        <label for="inputPassword5" class="form-label">Password</label>
        <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
    </div>
    <div class="login_form_container_btn_container">
        <button type="submit" class="btn btn-light login_form_container_btn_container_btn">Login</button>
    </div>
</form>
@endsection
