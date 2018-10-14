@extends('layout')

@section('content')
<form action="{{ route('messages.store') }}" method="POST" id="new-msg-form" class="col-6 offset-3">
    <div class="form-group">
        <select name="receiver_id" id="" class="form-control">
            <option disabled selected>Recipient</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
        <div class="form-group">
            <input type="text" name="subject" placeholder="Subject" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="body" placeholder="Write your message here." class="form-control">
        </div>

        <button type="submit" class="btn btn-default">Send</button>
    </form>
@endsection