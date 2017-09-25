<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('lib/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/bootstrap/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>OAuth test</title>
    </head>
    <body>
        <div id="root"></div>

        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    </body>
</html>