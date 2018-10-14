
    <div class="col-12" id="topnav">
            <div id="menu-btn">
                <div></div>
                <div></div>
                <div></div>
            </div>

            @if(!Auth::guest()) 
            <div class="dropdown show" id="menu">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
            
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <li class="dropdown-item"><a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">Edit account</a></li>
                <li class="dropdown-item">
                    <form action="{{ route('logout')}}" method="POST">
                        <button>Logout</button>
                        {{csrf_field()}}
                    </form>
                </li>
                </ul>
            </div>
            @else
            <ul id="menu">
            <li><a href="{{ route('login') }}" class="btn btn-default">Sign in</a></li>
            <li><a href="{{ route('register') }}" class="btn btn-primary">Sign up</a></li>
            </ul>
            @endif
    </div>

