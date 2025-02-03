@extends('layouts.main')
@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error )
    <div class="first_error">
        {{$error}}
    </div>
    @endforeach
@endif
<h1>
    New Notifications
</h1>
<ul>
@foreach ($unreadNotifications as $notification)
<div class="list-group notification">

      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ $notification->data['sender_name'] }}</h5>
      </div>
      <p class="mb-1">{{ $notification->data['message'] }}</p>
      <div>
        @if ($notification->data['message'] == "Declined your frend request!" || $notification->data['message'] == "Accepted your frend request!")
        <form action="{{route('markRead')}}" method="POST">
            @csrf
            <input type="hidden" name="notification_id" value="{{$notification->id}}"/>
            <button type="submit" class="btn btn-outline-secondary notification_btn" name="sender_id" value="{{$notification->data['sender_id']}}">X</button>
        </form>
        @else
        <form action="{{route('addBack')}}" method="POST">
            @csrf
            <input type="hidden" name="notification_id" value="{{$notification->id}}"/>
            <button type="submit" class="btn btn-outline-light notification_btn" name="id" value="{{$notification->data['sender_id']}}">Add Back</button>
        </form>
        <form action="{{route('decline')}}" method="POST">
            @csrf
            <input type="hidden" name="notification_id" value="{{$notification->id}}"/>
            <button type="submit" class="btn btn-outline-danger notification_btn" name="sender_id" value="{{$notification->data['sender_id']}}">Decline</button>
        </form>
        @endif

      </div>

</div>
@endforeach
</ul>
<h1>
    Read Notifications
</h1>
<ul>
    @if (isset($readNotifications))
    @foreach ($readNotifications as $notification)
    <div class="list-group notification">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $notification->data['sender_name'] }}</h5>
          </div>
          <p class="mb-1">{{ $notification->data['message'] }}</p>
          <div>
          </div>
    </div>
    @endforeach
    @endif

    </ul>
@endsection
