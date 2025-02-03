@extends('layouts.main')
@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error )
    <div class="first_error">
        {{$error}}
    </div>
    @endforeach
@endif

@if (isset($friends))
@foreach ($friends as $friend)
    <div class="card delete_friend">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h2 class="card-title">{{$friend->name}}</h2>
              <h5 class="card-text">{{$friend->email}}</h5>


            <form action="{{route('deleteFriend')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light" name="id" value="{{$friend->id}}">Delete Friend</button>
            </form>
        </div>
    </div>
@endforeach

@endif
@endsection
