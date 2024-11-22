<html>
    <head>
        @include('includes.head')
    </head>

    <body>
        <div id='sidebar'>
            @include('includes.sidebar')
        </div>
        <div id='content'>
            @yield('content')
        </div>
    </body>
</html>
