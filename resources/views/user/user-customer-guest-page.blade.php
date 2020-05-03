@extends('layouts.menu')
@section('styles')
    <link rel="stylesheet" href="{{asset('/css/myStyle/account-info.css')}}">
@endsection
@section('content')

    <div class="container emp-profile">

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        @if($user->thumbnail)
                            <img src="/uploads/thumbnails/{{$user->thumbnail}}" alt ="#"/>
                        @endif



                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$user->name}}
                        </h5>
                        <h6>

                         Роль:   Заказчик
                        </h6>
                        <p class="proile-rating">Рейтинг: <span>{{floor($user->avgMark())}}/100</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">О пользователе</a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Имя</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Фамилия</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->surname}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Телефон</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->phone_number}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
