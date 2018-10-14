     <nav class="col-3 col-lg-2">
        <i class="far fa-times-circle" id="close-btn"></i>
         <a href="{{route('home')}}" id="logo">
            <i class="fab fa-youtube"></i>
            <h1 id="title">TV Guide</h1>
         </a>
        <ul>
     @foreach($channelsMenu as $channel)
     <li>
         <h3>{{$channel->name}}</h3>
         <ul class="submenu">
             @foreach($channel->shows as $show)
             <li><a href="{{ route('shows.index', ['id'  => $show->id ])}}">{{ $show->name }}</a></li>
             @endforeach
         </ul>
     </li>
     @endforeach
    </ul>
    
</nav>