@extends('layout')

@section('content')


    <div class="col-12" id="latest-shows">   
        <h4>Latest shows</h4>
        <div class="row">
        @foreach($latestShows as $show)
            <div class="col-12 col-md-6 col-xl-4">
                <a href="{{ route('shows.index', ['id' => $show->id]) }}">
                    <img src="{{ asset('images/'.$show->image) }}" alt="{{$show->name}}" class="img-fluid">
                        <p>{{ $show->name }}</p>
                    </a>
            </div>
        @endforeach
        </div>
    </div>

    <div class="col-12" id="popular-shows"> 
            <h4>Most popular</h4>
            <div class="row">
            @foreach($popularShows as $show)
            <div class="col-12 col-md-6 col-xl-4">
            <a href="{{ route('shows.index', ['id' => $show->id]) }}">
            <img src="{{ asset('images/'.$show->image) }}" alt="{{$show->name}}" class="img-fluid">
                <p>{{ $show->name }}</p> <span>{{ number_format($show->rating, 1) }} <i class="fas fa-star"></i></span>
            </a>
            </div>
        @endforeach
        </div>
    </div>

        


@endsection