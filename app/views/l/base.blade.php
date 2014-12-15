<!DOCTYPE html>
 <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            @section('title')
            @show{{-- page Title --}}
        </title>
        <meta name="description" content="@yield('description')">{{-- Page Description --}}
        <meta name="keywords" content="@yield('keywords')" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @section('beforeStyle')
        @show
        @section('style')
        @show
        @section('afterStyle')
        @show

    </head>
    <body>
        <div class="site_container">
            @yield('body')
        </div>

        @section('beforeScript')
        @show
        @section('end')
        @show

    </body>
</html>
