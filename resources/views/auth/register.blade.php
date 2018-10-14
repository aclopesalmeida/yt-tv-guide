@extends('layout')

@section('content')
<form action="{{ route('register') }}" method="POST" class="col-12 col-md-6 offset-md-3 user-form">
        <h2 class="title">Create an account</h2>

       @include('inc.validation-errors')

        <div class="form-group">
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="form-control">
            </div>    
    
    <div class="form-group">
    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control">
        </div>

        <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Repeat your password" class="form-control">
            </div>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-default">Sign up</button>
    </form>
@endsection