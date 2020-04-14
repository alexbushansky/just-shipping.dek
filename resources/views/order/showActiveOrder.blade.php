@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle/customerOfferShow.css')}}">

@endsection


@section('content')


    <div class="container">
        <h3>Активный Заказ</h3>

        <div class="row">


            <div class="col-md-5">

                <div class="shadow-lg bg-white rounded">
                    @if(count($photos) > 1)
                        <a data-fancybox-trigger="preview" href="javascript:;" >
                            <img class = 'img-fluid' src="{{'/uploads/fullCustomerPhoto/'.$photos[0]}}">
                        </a>

                        @foreach($photos as $photo)

                            <a href="{{'/uploads/fullCustomerPhoto/'.$photo}}" data-fancybox="preview" data-width="1500" data-height="1000">
                                <img src="{{'/uploads/customerThumbnailPhoto/'.$photo}}" class="my-img" />
                            </a>

                        @endforeach

                    @else
                        <a data-fancybox="gallery" href="{{'/uploads/fullCustomerPhoto/'.$photos[0]}}">
                            <img class = 'img-fluid' src="{{'/uploads/fullCustomerPhoto/'.$photos[0]}}">
                        </a>
                    @endif
                </div>




            </div>

            <div class="col-md-7">

                <div class="row">
                    <div class="col-md-6" >
                        <ul>
                            <li><ul><strong>Откуда</strong>
                                <li><a class="small">Страна: </a>{{$order->fullAddressFrom->country->name}}</li>
                                <li><a class="small">Область: </a>{{$order->fullAddressFrom->region->name}}</li>
                                <li> <a class="small">Город: </a>{{$order->fullAddressFrom->city->name}}</li>
                                    @if($order->fullAddressFrom->street_name)
                                 <li><a class="small">Улица: </a> {{$order->fullAddressFrom->street_name}}</li>
                                    @elseif($order->fullAddressFrom->house_number)
                                 <li> <a class="small">Дом: </a>{{$order->fullAddressFrom->house_number}}</li>
                                        @endif
                                </ul>



                            <br>
                            <li><ul><strong>Куда</strong>
                                    <li><a class="small">Страна: </a>{{$order->fullAddressTo->country->name}}</li>
                                    <li><a class="small">Область: </a>{{$order->fullAddressTo->region->name}}</li>
                                    <li> <a class="small">Город: </a>{{$order->fullAddressTo->city->name}}</li>
                                    @if($order->fullAddressTo->street_name)
                                        <li><a class="small">Улица: </a> {{$order->fullAddressTo->street_name}}</li>
                                    @elseif($order->fullAddressTo->house_number)
                                        <li> <a class="small">Дом: </a>{{$order->fullAddressTo->house_number}}</li>
                                    @endif
                                </ul>
                                <br>

                            <li><strong>Цена за 1 км: </strong>{{$order->price_per_km}} грн</li>
                            <div id = 'price'><strong>Общая стоимость~ </strong></div>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li><strong>Октуально до: </strong>{{$order->date_finish}}
                            <li><strong>Тип груза: </strong>
                                @foreach($order->cargoType as $type)
                                    {{$type->type_name}}
                                @endforeach</li>
                            <li><strong>Вес: </strong>{{$order->weight}} кг</li>
                            <li><strong>Объем: </strong>{{$order->capacity}} м3</li>
                            <div id="duration"><strong>Время:~ </strong></div>
                            <div id="distance"><strong>Расстояние:~ </strong></div>
                            <li><strong>Заказчик: </strong>{{$order->customer->user->name}}</li>
                            <li><strong>Перевозчик: </strong>{{$order->driver->user->name}}</li>

                        </ul>
                        <div>
                            <a class="btn btn-info">Диалог</a>
                        </div>
                    </div>

                </div>


            </div>

        <div class="col-md-12">
        <div id="map" style="width: 100%; height: 300px; margin-top: 20px;margin-bottom: 20px"></div>
        </div>

            <div class="col-md-6">
                <form>
                    <a href="#" style="margin-top: 20px;margin-bottom: 20px" class="btn btn-sm btn-primary">Отказаться</a>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <form action="{{route('completeOrder',['id'=>$order->id])}}" method="POST">
                    @csrf
                    <button type="submit" style="margin-top: 20px;margin-bottom: 20px" class="btn btn-sm btn-primary">Завершить</button>

                </form>
            </div>





        <div class="row d-flex justify-content-left">


            <div class="col-md-12 text-left">

                <hr>
                <h4 class="h4">Описание</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
                    voluptates,
                    quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>
                <hr>
            </div>

        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>

            <script type="text/javascript"
                    src="http://maps.google.com/maps/api/js?key={{env('REACT_APP_GOOGLE_API_KEY')}}"></script>

    <script src="{{asset('js/activeOrder/map.js')}}"></script>
    <script>


        var latFrom = {{json_decode($latLngFrom)->lat}};
        var lngFrom = {{json_decode($latLngFrom)->lng}};
        var lngTo = {{json_decode($latLngTo)->lng}};
        var latTo = {{json_decode($latLngTo)->lat}};


        window.onload =(direction(latFrom,lngFrom,latTo,lngTo,{{$order->price_per_km}}));
    </script>
@endsection
