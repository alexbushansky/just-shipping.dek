@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/range.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/customerOffer.css')}}">

@endsection

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 filter">

                <br>

                <form method="get" action="{{route('customer-offers.index')}}">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Поиск" name="title" value="{{request()->query('title')}}">
                    </div>
                    <a class="text-decoration-none nav-link my-addOne" href="#">Укажите место отправления</a>
                <div class="addressOne hide">
                    <fieldset>
                        <legend>Country</legend>
                        <select  class="form-control select-country" name="country_id_from" >
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Region</legend>
                        <select class="form-control select-region" name="region_id_from">

                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>City</legend>
                        <select class="form-control select-city" name="city_id_from">

                        </select>
                    </fieldset>
                </div>

                    <a class="text-decoration-none nav-link my-addTwo" href="#">Укажите место прибытия</a>

                <div class="addressTwo hide">
                    <fieldset>
                        <legend>Country</legend>
                        <select  class="form-control select-country-two" name="country_id_to" >
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Region</legend>
                        <select class="form-control select-region-two" name="region_id_to">

                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>City</legend>
                        <select class="form-control select-city-two" name="city_id_to">

                        </select>
                    </fieldset>
                </div>
                    <hr>
                    <fieldset>
                        <legend>Цена за 1 км</legend>
                        <div class="slidecontainer">
                            <div class="showPrice">0</div>
                            <input type="range" min="1" max="200" value="0" class="slider" name = "price_per_km">
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Объем</legend>

                            <input class="form-control" type="number" placeholder="М3"   name = "capacity">
                    </fieldset>

                    <fieldset>
                        <legend>Масса от</legend>
                        <input class="form-control" type="number" placeholder="Тонны"   name = "weight">
                    </fieldset>

                    <fieldset>

                        <legend>Тип груза</legend>
                        <select  class="form-control" name="type_of_cargo">
                            <option selected value="">Выберите груз</option>
                            @foreach($typesOfCargo as $type)
                                <option value="{{$type->id}}">{{$type->type_name}}</option>
                            @endforeach

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

            <div class="col-md-9">
                <div class="orders">
            @if($customerOffers->count() > 0 )

                @foreach($customerOffers as $offer)
                        <div class="card">
                            <a data-fancybox="gallery" href="{{'/uploads/fullCustomerPhoto/'.json_decode($offer->gallery)[0]}}">
                                <img class = 'img-fluid' src="{{'/uploads/fullCustomerPhoto/'.json_decode($offer->gallery)[0]}}">
                            </a>
                            <div class="card-body">
                                <ul>
                                    <li><h5><strong> {{$offer->title}}</strong></h5></li>
                                    <li><strong>Откуда : </strong> {{$offer->fullAddressFrom->country->name}},{{$offer->fullAddressFrom->city->name}}</li>
                                    <li><strong>Куда : </strong> {{$offer->fullAddressTo->country->name}},{{$offer->fullAddressTo->city->name}}</li>




                                    <li><strong>Цена за 1 км: </strong>{{$offer->price_per_km}}</li>
                                </ul>
                                <div class="row">

                                    <div class="col-md-6"> <a class="btn btn-success" href="{{route('customer-offers.show',['customerOffer'=>$offer->id])}}">Детальнее</a></div>

                                </div>
                            </div>
                        </div>

                    @endforeach
               </div>
                {{$customerOffers->links()}}

                @else
                <br>
                <h4>По вашому запросу ничего не найдено</h4>

            @endif
            </div>
@endsection





@section('scripts')

                <script src="{{asset('/js/select.js')}}"></script>
                <script src="{{asset('/js/range.js')}}"></script>
                <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>
                <script>
                    $(function() {
                        $('.my-addOne').on('click', function(e) {
                            e.preventDefault();
                            $('.addressOne').toggleClass('hide');
                        });
                    });
                    $(function() {
                        $('.my-addTwo').on('click', function(e) {
                            e.preventDefault();
                            $('.addressTwo').toggleClass('hide');
                        });
                    });
                </script>
@endsection



