<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Latex</title>

        <script src="{{ asset('node_modules/mathjax/es5/tex-mml-chtml.js') }}"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
    </head>

    <body class="antialiased">

        <div id="latex">
            {!! $latex !!}
        </div>
        <script>
            MathJax.typesetPromise(["#latex"]);
        </script>

    </body>