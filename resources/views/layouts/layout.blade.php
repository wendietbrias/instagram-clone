<!DOCTYPE html>
<html>
    <head>
        @isset($title) 
        <title>{{ $title }}</title>
        @endisset
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="content" charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        @yield("packages")
    </head>
    <body>
        @yield('content')

        @yield("js")
    </body>
</html>