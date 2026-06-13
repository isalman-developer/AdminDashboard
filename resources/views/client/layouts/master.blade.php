<!DOCTYPE html>
<html lang="en">

<head>
        <title>{{ site_settings()[0]['name'] ?? 'E-commerce'}}</title>
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
