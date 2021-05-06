<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Vue</title>
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/apps.css')}}">
        <style>
            a.router-link-active {
            background:#252735
            }
            li.router-link-active a {
                color: #3f0909
            }
        </style>
    </head>
    <body>
       <div id="app">
           <app-component/>
       </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/apps.js') }}" defer></script>
    <script src="{{ asset('js/vendors.js') }}"></script>
</html>