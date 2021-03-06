@extends('layouts.menu')
@section('styles')
    <link rel="stylesheet" href="{{asset('/css/myStyle/account-info.css')}}">
@endsection
@section('content')


    <div class="container emp-profile">
        <form method="post" action="{{route('users.update',['user'=>$user->id])}}">
            @csrf
            @method('PUT')
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
                            Роль:
                            @role('driver')
                            Перевозчик
                            @endrole
                            @role('customer')
                            Заказчик
                            @endrole
                            @role('admin')
                            Администратор
                            @endrole

                        </h6>
                        <p class="proile-rating">Рейтинг: <span>{{floor($user->avgMark())}}/100</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">О вас</a>
                            </li>
                           @role('driver')
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Транспорт</a>
                            </li>
                          @endrole
                        </ul>
                    </div>
                </div>

                <div class="col-md-2">
                   <h6> <a href="{{route('users.edit',['user'=>$user->id])}}">Редактировать</a></h6>
                    <br>
                    @role('driver')

                    <h6> <a href="{{route('driver-car.create')}}">Добавить транспорт</a></h6>
                    @endrole
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
                            @role('driver')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">

                                <div class="orders">
                                    @if($cars->count()>0)

                                    @foreach($cars as $car)
                                    <div class="card">
                                        <img src="{{asset('uploads/cars/'.$car->thumbnail)}}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <ul>
                                                <li>{{$car->model_of_car}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach

                                    @else
                                        <h4>Список пуст</h4>
                                    @endif
                            </div>
                        </div>


                    </div>


            </div></div>
            </div>
           @endrole

        </form>
    </div>

@endsection
