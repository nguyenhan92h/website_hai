<!DOCTYPE html>
 <html>
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
    <body class="login-body" cz-shortcut-listen="true">

        @yield('body')

        @section('end')
        @show

    </body>
</html>
