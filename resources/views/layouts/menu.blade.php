<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', App()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','Laravel') }}</title>
    <link rel="icon" href="{!! asset('img/truck.png') !!}"/>


    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap-grid.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle/fonts.css')}}">



    <!-- Styles -->

    @yield('styles')

</head>
<body>
@php
    $user = auth()->user();
@endphp

<nav class="navbar navbar-expand-lg menu">
    <a class="navbar-brand" href="/">Just Shipping</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><img src="https://img.icons8.com/color/30/000000/menu.png"/></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('customer-offers.index')}}">Заказы <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('driver-offers.index')}}">Перевозчики</a>
            </li>
{{--            @if($user)--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('driver-offers.index')}}"><span class="badge badge-light" id="offer-count">--}}

{{--                        @php--}}
{{--                        $count = \App\Models\Dialog::where('recipient_id','=',$user->id)->sum('recipient_new');--}}

{{--                        echo $count--}}
{{--                        @endphp--}}

{{--                    </span></a>--}}
{{--            </li>--}}
{{--            @endif--}}

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="google.com" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ваши заказы
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="{{route('showActiveOrders')}}">Активные заказы</a>

                        <a class="dropdown-item" href="{{route('completedOrders')}}">Выполненные заказы</a>
                        <a class="dropdown-item" href="{{route('showDialogs')}}">Предложения</a>
                        @role('driver')
                        <a class="dropdown-item" href="{{route('driver-offers.create')}}">Добавить заказ</a>
                        @endrole

                        @role('customer')
                        <a class="dropdown-item" href="{{route('customer-offers.create')}}">Добавить заказ</a>
                        @endrole

{{--                            <a class="dropdown-item" href="{{route('driver-offers.create')}}">Добавить заказ</a>--}}



                    </div>

                </li>
            @endauth

        </ul>



        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name}} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>
                            @role('admin')
                        <a class="dropdown-item" href="{{route('admin')}}">Админ Панель</a>
                            @endrole


                        <a class="dropdown-item" href="{{route('users.show',['user'=>$user->id])}}">Личный кабинет</a>



                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>


            @endguest
        </ul>

    </div>
</nav>


    <main class="py-4">
        @if (session('status'))

            <div
                class="alert @if(session('alert'))alert-{{session('alert')}} @else alert-success @endif alert-dismissible fade show"
                role="alert">
                {{ session('status') }}
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        @if ($errors->any())

            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif


        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/bundle.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>
