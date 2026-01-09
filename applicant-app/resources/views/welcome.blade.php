<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTDC</title>

    @vite('resources/css/app.css')
</head>
<body class="text-center px-8 py-12">
    <h2>Welcome to MTDC</h1>

    <a href="/search" class="btn-primary">
    APPLICANT SEARCH
    </a>

</body>
</html>