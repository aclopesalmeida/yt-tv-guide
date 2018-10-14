@extends('layout')

@section('content')
<div class="col-12" id="season">
    <div id="show-title">
        <i class="fas fa-caret-right"></i>
        <h1>{{ $show->name }}</h1>
    </div>

    <div class="col-12" id="seasons">
            <h5>Seasons</h5>
            <ul>
                @foreach($show->seasons as $season)
                <li class="{{ $season->number ==  $currentSeason ? 'active' : ''}}">
                    <a href="#" data-id="{{ $show->id }}" data-season="{{ $season->number }}">Season {{ $season->number }}</a>
                </li>
                @endforeach
            </ul>
    </div>




    <div class="col-12" id="videos">
     @include('inc.videos')
    </div>

</div>


</div>





@endsection