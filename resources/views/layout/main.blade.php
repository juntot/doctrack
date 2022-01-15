<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layout.head')
    <body>
        <!-- nav -->
        @include('layout.nav')
        
        <!-- main -->
        @yield('main')
        <!-- footer -->
        @include('layout.footer')
    </body>
</html>
