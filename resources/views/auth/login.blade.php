@extends('layout')

@section('content')
<form action="{{ route('login') }}" method="POST" class="col-10 offset-1 col-md-4 offset-md-4 user-form">
    <h2 class="title">Login</h2> 
    @include('inc.validation-errors')   
    <div class="form-group">
            <input type="text" name="email" placeholder="Email" class="form-control">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control">
        </div>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-default">Sign in</button>
    </form>
@endsection