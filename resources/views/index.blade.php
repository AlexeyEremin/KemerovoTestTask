<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Главная страница')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.statuses')
    <div class="container p-3 border text-center">
        @auth
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#csvUploadModal">
                Загрузить CSV
            </button>
            <a href="{{ route('logout') }}" class="btn btn-danger">Выйти</a>
        @endauth
        @guest
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Авторизация
            </button>
        @endguest
    </div>
    @yield('content')
    @include('user.auth')
    @include('csv.csv-modal')
    @include('components.report-modal')
    @auth
        <input type="hidden" id="apiToken" value="{{ session('token') }}">
    @endauth
</body>
</html>