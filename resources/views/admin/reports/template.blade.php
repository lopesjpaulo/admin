<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
    </head>
    <body>
        <h1 style="text-align: center;">{{ $title }}</h1>
        <p><b>Gestor:</b> {{ $gestor }}</p>
        <p>{{ utf8_decode(strip_tags($conteudo)) }}</p>
    </body>
</html>