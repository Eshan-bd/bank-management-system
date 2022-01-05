<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<title>
    @yield('title')
</title>

<body>
    @include('includes.home.homeheader')
    @include('includes.home.homenavbar')
    
    @yield('content')
</body>
</html>

