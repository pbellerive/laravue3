<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="icon" type="image/jpg" href="/images/favicon.jpg">

        <title>laravue</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    </head>
    <body class="text-black min-h-screen">
        <div id="app" class="w-full min-h-screen h-full flex">
            <side-menu></side-menu>
            <div class="w-full h-full">
                <page-header v-if="$router.currentRoute.name != 'home' && $router.currentRoute.name != 'login'"></page-header>
                <router-view class="h-full"></router-view>
                <footer>

                </footer>
                <notification></notification>
            </div>
        </div>
    </body>

    <script src="{{mix('/js/app.js')}}"></script>
</html>