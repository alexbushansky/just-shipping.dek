@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle/customerOfferShow.css')}}">

@endsection


@section('content')


    <div class="container">
        <h3>Выполненный Заказ</h3>

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
                            <li><strong>Дата начала: </strong>{{$order->created_at}}
                            <li><strong>Дата окончания: </strong>{{$order->updated_at}}
                            <li><strong>Тип груза: </strong>
                                @foreach($order->cargoType as $type)
                                    {{$type->type_name}}
                                @endforeach</li>
                            <li><strong>Вес: </strong>{{$order->weight}} кг</li>
                            <li><strong>Объем: </strong>{{$order->capacity}} м3</li>
                            <div id="duration"><strong>Время:~ </strong></div>
                            <div id="distance"><strong>Расстояние:~ </strong></div>
                            <li><strong>Заказчик: </strong><a href="{{route('guest-room',['id'=>$order->customer->user->id])}}">{{$order->customer->user->name}}</a></li>
                            <li><strong>Перевозчик: </strong><a href="{{route('guest-room',['id'=>$order->driver->user->id])}}">{{$order->driver->user->name}}</a></li>

                        </ul>
                        <div>
                            <a class="btn btn-info">Диалог</a>
                        </div>
                        <br>
                        <div>


                        </div>
                    </div>

                </div>







                <div class="row">

                    @role('driver')
                    @if(in_array($order->driver->user->id,$rolesArray))

                        <div class="col-md-6">
                            Оценка сотрдуничества от <a href="{{route('guest-room',['id'=>$order->customer->user->id])}}">{{$order->customer->user->name}}</a>
                            <br>

                            <div class="star-raiting">
                                <div data-raiting="1" class="star-show"></div>
                                <div data-raiting="2" class="star-show"></div>
                                <div data-raiting="3" class="star-show"></div>
                                <div data-raiting="4" class="star-show"></div>
                                <div data-raiting="5" class="star-show"></div>
                                <div class="star-raiting-bg" style = "width:{{$mark}}%">
                                </div>
                            </div>


                        </div>
                    @endif

                    @if(!in_array($order->customer->user->id,$rolesArray))
                        <div class="col-md-6">
                            <button data-toggle="modal" data-target = "#sendMark" class="btn btn-primary"> Оценить Сотрудничство</button>
                        </div>
                    @endif

                    @endrole

                    @role('customer')

                        @if(in_array($userId,$rolesArray))

                            <div class="col-md-6">
                                Оценка сотрдуничества от  <a href="{{route('guest-room',['id'=>$order->driver->user->id])}}">{{$order->driver->user->name}}</a>
                                <br>
                                <div class="star-raiting">
                                    <div data-raiting="1" class="star-show"></div>
                                    <div data-raiting="2" class="star-show"></div>
                                    <div data-raiting="3" class="star-show"></div>
                                    <div data-raiting="4" class="star-show"></div>
                                    <div data-raiting="5" class="star-show"></div>
                                    <div class="star-raiting-bg" style = "width:{{$mark}}%">
                                    </div>
                                </div>
                            </div>
                            @endif
                        @if(!in_array($order->driver->user->id,$rolesArray))
                            <div class="col-md-6">
                                <button data-toggle="modal" data-target = "#sendMark" class="btn btn-primary"> Оценить Сотрудничство</button>
                            </div>
                        @endif

                    @endrole


                </div>


            </div>



            <div class="col-md-12">
                <div id="map" style="width: 100%; height: 300px; margin-top: 20px;margin-bottom: 20px"></div>
            </div>



            <div class="row d-flex justify-content-left">


                <div class="col-md-12 text-left">

                    <br>


                    <div id = "sendMark" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title">Оцените сотрудничество</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('postMark')}}" method="post">


                                    @csrf
                                    @role('customer')
                                    <input type="hidden" value="2" name="type_id">
                                    <input type="hidden" value="{{$order->driver->user->id}}" name="user_id">
                                    @else
                                        <input type="hidden" value="1" name="type_id">
                                        <input type="hidden" value="{{$order->customer->user->id}}" name="user_id">
                                    @endrole

                                    <input type="hidden" value="{{$order->id}}" name="order_id">

                                    <input type="hidden" name="raiting">

                                    <div class="modal-body">
                                        <div class="success-message">

                                        </div>
                                        <div class="star-raiting">
                                            <div data-raiting="1" class="star starMark"></div>
                                            <div data-raiting="2" class="star starMark"></div>
                                            <div data-raiting="3" class="star starMark"></div>
                                            <div data-raiting="4" class="star starMark"></div>
                                            <div data-raiting="5" class="star starMark"></div>
                                            <div class="star-raiting-bg-modal star-raiting-bg"></div>

                                        </div>
                                        <br>
                                        <strong >Ваша оценка <a id = 'mark'></a> из 100</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Оценить</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4 class="h4">Описание</h4>

                    <p>{{$order->description}}</p>
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

            <script>
                $(function () {
                    $('.starMark').click(function () {

                        var raiting = $(this).data('raiting');
                        console.log(raiting);
                        var bgHeight = parseInt(raiting) * 20;

                        var bg = $('.star-raiting-bg-modal');

                        bg.css('width', bgHeight + '%');
                        $('input[name="raiting"]').val(bgHeight);
                        $("#mark").html(bgHeight);
                    })
                })
            </script>


        @endsection

