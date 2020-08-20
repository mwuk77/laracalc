<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lara-calc</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <!-- JS -->
        <script src="{{ asset('js/app.js') }}"></script>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1>Lara-calc</h1>    
                
                @yield('calculator', View::make('calculator', 
                    ['buttons' => $buttons]
                ))
                
            </div>
        </div>
    </body>
</html>
