@extends('layouts.main')
@section('content')

@if (isset($users))

@foreach ($users as $user)
<form class="usersForm" action="{{ route('allusers') }}" method="POST">
    @csrf
    <div class="card usersForm_usersCard">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{$user->name}}</h5>
              <p class="card-text">{{$user->email}}</p>
            @if (Auth::user()->admin)
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="admin" @if($user->admin == 1) checked @endif >
                <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="active" @if($user->active == 1) checked @endif >
                <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>
            </div>
                <button type="submit" class="btn btn-light" name="id" value="{{$user->id}}">Save</button>
            @endif
                <button type="submit" class="btn btn-light" name="id" value="{{$user->id}}">Add Friend</button>
            </div>
        </div>
</form>
@endforeach

@endif
@endsection
