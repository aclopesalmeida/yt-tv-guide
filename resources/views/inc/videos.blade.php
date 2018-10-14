
        <div class="row">
        @foreach($videos as $video)
        <div class="col-12 col-lg-6 video">
            <div>
            <iframe width="460" height="269" src="https://www.youtube.com/embed/{{ $video['snippet']['resourceId']['videoId'] }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        @endforeach
    </div>

        @if($totalResults > 6 && !$endLoop)
        <a href="#" id="load-more-btn" class="btn btn-primary" data-id="{{$show->id}}" data-pg="{{$nextPage}}" data-season="{{ $currentSeason }}">Ver mais</a>
        @endif
