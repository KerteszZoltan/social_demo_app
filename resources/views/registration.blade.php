@extends('layouts.main')
@section('content')
<form class="registration_form_container" action="{{ route('registration') }}" method="POST">
    @csrf
    <div class="registration_form_container_title">Registration</div>
    @if ($errors->any())
        @foreach ($errors->all() as $error )
            {{$error}}
        @endforeach
    @endif
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Gipsz Jakab">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        <label for="inputPassword5" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
        <label for="inputPassword5" class="form-label">Password again</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
    </div>
    <div class="registration_form_container_btn_container">
        <button type="submit" class="btn btn-light registration_form_container_btn_container_btn">Registration</button>
    </div>
</form>
@endsection