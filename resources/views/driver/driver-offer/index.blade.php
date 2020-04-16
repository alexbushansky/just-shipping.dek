@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/range.css')}}">
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">

@endsection

@section('content')



    <div class="container-fluid">
        <div class="row">
            {{--Filters --}}
            <div class="col-md-3 filter">

                <br>

                <form method="get" action="{{route('driver-offers.index')}}">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Поиск" name="title" value="{{request()->query('title')}}">
                    </div>

                    <fieldset>
                        <legend>Страна</legend>
                        <select  class="form-control select-country" name="country_id" >
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Регион</legend>
                        <select class="form-control select-region" name="region_id">

                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Город</legend>
                        <select class="form-control select-city" name="city_id">

                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Цена за 1 км от</legend>
                        <div class="slidecontainer">
                            <div class="showPrice">0</div>
                            <input type="range" min="1" max="200" value="0" class="slider" name = "price_per_km">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Вес груза от</legend>
                        <div class="slidecontainer">
                            <div class="showPrice">0</div>
                            <input type="range" min="1" max="{{$max}}" value="0" class="slider" name = "weight">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Объем груза от</legend>
                        <div class="slidecontainer">
                            <div class="showPrice">0</div>
                            <input type="range" min="1" max="200" value="0" class="slider" name = "capacity">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Тип груза</legend>

                        <select id="select_regions" class="form-control" name="type_of_cargo">
                            <option selected value="">Выберите тип</option>
                            @foreach($types as $type)
                            <option @if(request()->query('type_of_cargo') == $type->id) selected @endif value="{{$type->id}}">{{$type->type_name}}</option>
                            @endforeach
                        </select>
                    </fieldset>




                    <span class="form-group">
                        <button class="btn btn-sm btn-primary" type="submit">Потвердить</button>
                    </span>
                </form>


            </div>
        {{--Main Part of Driver Offers --}}
            <div class="col-md-9">
                <div class="orders">
                    @if($driverOffers->count() > 0 )



                        @foreach( $driverOffers as $offer)



                                <div class="card">


                                        <img class = 'card-img-top' src="{{'/uploads/fullPhotoCars/'.$offer->thumbnail}}">

                                    <div class="card-body" onclick="window.location.href='{{route('driver-offers.show',['driverOffer'=>$offer->id])}}'">
                                        <ul>
                                            <li><h5><strong>{{$offer->title}}</strong></h5></li>
                                            <li>Расположение: {{$offer->country->name}}, {{$offer->city->name}}</li>
                                            <li>Цена за 1 км: {{$offer->price_per_km}} грн</li>
                                            <li>Грузоподьемность: {{$offer->weight}} кг</li>
                                            <li>Тип транспорта: {{$offer->carType->name_car_type}}</li>
                                            <li>Объем: {{$offer->weight}} м<sup><small>3</small></sup></li>


                                            <br>
                                            <div class="row">

                                                <div class="col-md-6"> <a class="btn btn-success" href="{{route('driver-offers.show',['driverOffer'=>$offer->id])}}">Детальнее</a></div>

                                            </div>


                                        </ul>
                                    </div>
                                </div>


                        @endforeach

                         </div>
                    @else
                        <br>
                        <h4>По вашому запросу ничего не найдено</h4>

                    @endif


                        <div>{{$driverOffers->links()}}</div>
            </div>

        </div>
    </div>

@endsection


@section('scripts')


    <script src="{{asset('/js/select.js')}}"></script>
    <script src="{{asset('/js/range.js')}}"></script>
    <script>


    </script>

@endsection


