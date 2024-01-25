
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.head')
</head>

<body><!-- class="animsition" -->
    
    <!-- Header -->
    @include('layout.header')
    <!-- Cart -->
    {{-- @include('layout.cart') --}}

    @yield('content')

        

    <!-- Footer -->
    @include('layout.footer')
    @yield('js')

</body>

</html>

