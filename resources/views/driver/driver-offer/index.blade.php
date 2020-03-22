@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/range.css')}}">
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
                        <legend>Country</legend>
                        <select  class="form-control select-country" name="country_id" >
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Region</legend>
                        <select class="form-control select-region" name="region_id">

                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>City</legend>
                        <select class="form-control select-city" name="city_id">

                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Цена за 1 км</legend>
                        <div class="slidecontainer">
                            <div class="showPrice">0</div>
                            <input type="range" min="1" max="200" value="0" class="slider" name = "price_per_km">
                        </div>
                    </fieldset>

                    <fieldset>

                        <legend>Тип груза</legend>
                        <select id="select_regions" class="form-control" name="type_of_cargo">
                            <option disabled>Выберите груз</option>
                        </select>
                    </fieldset>




                    <span class="form-group">
                        <button class="btn btn-sm btn-primary" type="submit">{{__('Submit')}}</button>
                    </span>

                    <span class="form-group">
                        <button class="btn btn-sm btn-danger" type="reset">{{__('Reset')}}</button>
                    </span>
                </form>


            </div>
        {{--Main Part of Driver Offers --}}
            <div class="col-md-9">
                <div class="orders">
                    @if($driverOffers->count() > 0 )



                        @foreach( $driverOffers as $offer)



                                <div class="card" onclick="window.location.href='{{route('driver-offers.show',['driverOffer'=>$offer->id])}}'">
                                    <img src="{{asset('uploads/cars/'.$offer->thumbnail)}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <ul>
                                            <li><h5><strong>{{$offer->title}}</strong></h5></li>
                                            <li>Расположение: {{$offer->country->name}}, {{$offer->city->name}}</li>
                                            <li>Цена за 1 км: {{$offer->price_per_km}} грн</li>
                                            <li>Грузоподьемность: {{$offer->max_weight}} тонн(ы)</li>
                                            <li>Тип транспорта: {{$offer->carType->name_car_type}}</li>
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

    <script src="{{asset('/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/select2/js/i18n/ru.js')}}"></script>
    <script src="{{asset('/js/select.js')}}"></script>
    <script src="{{asset('/js/range.js')}}"></script>
@endsection


