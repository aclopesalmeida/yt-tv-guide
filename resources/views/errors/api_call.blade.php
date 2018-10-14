<html>
    <head>
    <meta charset="utf8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    </head>
    <body class="container-fluid" id="error">
        <div class="row" id="error-message">
            <div class="col-12">
                <h1>Ops! There was a problem loading this page. <br>Please try again.</h1>
                <a href="{{route('home')}}">Go back</a>
            </div>
        </div>

    </body>
</html>