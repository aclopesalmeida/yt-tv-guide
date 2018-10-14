@extends('layout')

@section('content')
<form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" class="col-12 col-md-6 offset-md-3 user-form">
    <h2 class="title">Edit user information</h2> 
    @include('inc.validation-errors') 
    <div class="form-group">
    <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" class="form-control">
    </div>

    <div class="form-group">
        <input type="text" name="email" placeholder="Email" value="{{ $user->email }}" class="form-control">
    </div>

    <div class="form-group">
            <input type="password" name="new_password" placeholder="New password." class="form-control">
    </div>

    <div class="form-group">
            <input type="password" name="new_password_confirmation" placeholder="Repeat the new password." class="form-control">
    </div>

    <div class="form-group">
            <input type="password" name="password" placeholder="Current password" class="form-control">
    </div>

        {{ csrf_field() }}
    

        <button type="submit" class="btn btn-default">Edit account</button>
    </form>
@endsection