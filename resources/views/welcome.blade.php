<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap-grid.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        <link rel="stylesheet" href="{{asset('css/myStyle/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/myStyle/fonts.css')}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>



                <nav class="navbar navbar-expand-lg menu">
                    <a class="navbar-brand" href="#">Just Shipping</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Заказы <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Перевозчики</a>
                            </li>
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="google.com" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ваши заказы
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Активные заказы</a>
                                    <a class="dropdown-item" href="#">Выполненные заказы</a>
                                    <a class="dropdown-item" href="#">Добавить заказ</a>
                                </div>

                            </li>
                            @endauth

                        </ul>



                        <ul class="navbar-nav ml-auto">

                            @if (Route::has('login'))

                                    @auth
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/home') }}">
                                            Личный кабинет
                                        </a>
                                    </li>
                                    @else

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">
                                                Вход
                                            </a>
                                        </li>

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">
                                                    Регистрация
                                                </a>
                                            </li>
                                        @endif

                                    @endauth

                            @endif
                        </ul>

                    </div>
                </nav>

            <div class="content">
                <div class="title m-b-md">

                </div>


            </div>
    </body>
</html>
