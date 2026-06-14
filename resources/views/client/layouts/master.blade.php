<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Ecommerce Store')</title>
    @include('client.partials.head')
</head>

<body>
    @include('client.partials.header')
    @include('client.partials.search')

    @yield('content')

    @include('client.partials.footer')
    @include('client.partials.scripts')
</body>

</html>
