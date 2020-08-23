<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lara-calc</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            <div class="balloon">
                <div><span>L</span></div>
                <div><span>A</span></div>
                <div><span>R</span></div>
                <div><span>A</span></div>
                <div><span>C</span></div>
                <div><span>A</span></div>
                <div><span>L</span></div>
                <div><span>C</span></div>
            </div>
            <div class="content">
                <?php
                    //If this were more complex it'd be better in a model.
                    $buttons = [
                        'C',
                        '7', '8', '9', '*',
                        '4', '5', '6', '-',
                        '1', '2', '3', '+',
                        '0', '.', '/', '='
                    ];
                ?>
                @yield('calculator', View::make('calculator', 
                    ['buttons' => $buttons]
                ))
                
            </div>
        </div>
                
        <!-- JS -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
