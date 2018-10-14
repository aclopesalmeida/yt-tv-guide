@extends('layout')

@section('content')

<div class="col-12" id="show">
    <div class="row">

        <div id="show-title" class="col-12">
                <i class="fas fa-caret-right"></i>
                <h1>{{ $show->name }}</h1>
        </div>

        <div class="col-12  col-lg-6 show-details">
            <div class="col-12" id="seasons">
                    <h5 class="col-12">Seasons</h5>
                    <ul class="col-12">
                        @foreach($show->seasons as $season)
                        <li>
                        <a href="{{ route('shows.season', ['show_id' => $show->id, 'season_id' => $season->number]) }}">Season {{$season->number}}</a>
                        </li>
                        @endforeach
                    </ul>
            </div>
            <div class="col-12 no-padding" id="show-info">
                <p>Channel: {{ $show->channel->name }}</p>
                @if(!is_null($show->rating))
                <div id="show-rating">
                        <h3>Rating: {{ number_format($show->rating, 1) }}</h3>
                        <i class="fas fa-star"></i>
                        <span>({{ $show->number_ratings }} {{ $show->number_ratings > 1 || $show->number_ratings == 0 ? 'ratings' : 'rating'}})</span>

                </div>
                @endif
            </div>
        </div>
        <div class="col-12 col-lg-6 show-details">
        <img src="{{ asset('/images/'. $show->image)}}" alt="{{ $show->name }}" class="img-fluid">
            <div id="rate-show">
                <ul>
                    @for($i = 1; $i <= 5; $i++)
                    <li class="{{ !is_null($userRating) && $i <= $userRating ? 'filled' : ''}}">
                        <form action="{{ route('ratings.store') }}" method="POST">
                        <input type="hidden" name="show_id" value="{{ $show->id }}">
                        <input type="hidden" name="number" value="{{ $i }}">
                        {{ csrf_field() }}
                        <button><i class="fas fa-star"></i></button>
                        </form>
                        </li>
                    @endfor
                </ul>
                @if(is_null($user) || is_null($userRating))
                    <p>Rate this show</p>
                @else
                    <p>Your rating</p>
                @endif
            </div>
        </div>

        <div class="col-12" id="comments">
            <h2>Comments</h2>
            @if(!Auth::guest())
                <form action="{{route('comments.store', ['show_id' => $show->id])}}" method="POST" class="col-12 col-md-8">
                        <div class="form-group">
                            <textarea name="body" placeholder="Your comment." class="form-control"></textarea>
                        </div>
                        <input type="hidden" name="id" value="{{$show->id}}">
                        <button class="btn btn-primary  ">Submit comment</button>
                </form>
            @else
                <p>You must be logged in to join the discussion.  <a href="{{route('login')}}">Login now &gt;&gt;</a></p>
            @endif

            @foreach($comments as $comment)
                <div class="comment">
                    <h4>{{$comment->user->name}}</h4>
                    <p>{{$comment->body}}</p>
                    <p class="date">on {{ date('d/m/Y   ', strtotime($comment->created_at))}}</p>
                </div>
            @endforeach
        </div> 

    </div>
</div>

@endsection