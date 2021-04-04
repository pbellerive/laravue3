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
    <body class="bg-black text-white h-screen">
            <div id="app" class="bg-black h-full">
                <page-header v-if="$router.currentRoute.name != 'home' && $router.currentRoute.name != 'login'"></page-header>
                <router-view class="h-full"></router-view>
                <footer>

                </footer>
                <notification ref="$notification"></notification>
            </div>
    </body>

    <script src="{{mix('/js/app.js')}}"></script>
    <script src="https://player.vimeo.com/api/player.js">
    </script>
</html>