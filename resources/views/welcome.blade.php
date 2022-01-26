<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prueba Nexura Líder Técnico de Desarrollo</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('common.header')
    </head>
    <body>
        <div id="app">
            <index-component></index-component>
        </div>
        @include('common.scripts')

    </body>
</html>
