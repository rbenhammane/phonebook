<!DOCTYPE html>
<html>
    <head>
        <title>Phone Book - @yield('title')</title>
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row header">
                <div id="logo" class="col-md-6"><a href="/">Phone Book</a></div>
                <div id="logout" class="pull-right">
                    @if (Auth::check())
                    <a href="/auth/logout">Logout</a>
                    @endif
                </div>
            </div>
            <div id="content" class="container">
                @section('content')
                @show
            </div>
        </div>
    </body>
</html>