@extends('layouts.main')
@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error )
        {{$error}}
    @endforeach
@endif

@if (isset($friends))
@foreach ($friends as $friend)
<form class="usersForm" action="{{ route('allFriends') }}" method="POST">
    @csrf
    <div class="card usersForm_usersCard">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h2 class="card-title">{{$friend->name}}</h2>
              <h5 class="card-text">{{$friend->email}}</h5>


            <form action="#" method="POST">
                @csrf
                <button type="submit" class="btn btn-light" name="id" value="">Delete Friend</button>
            </form>
            </div>
        </div>
</form>
@endforeach

@endif
@endsection
