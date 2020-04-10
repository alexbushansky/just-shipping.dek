@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">


@endsection

@section('content')


    <main>

        <div class="container dark-grey-text mt-4">


            <h3>{{$driverOffer->title}}</h3>

            <br>

            <div class="row">


                <div class="col-md-5">
                <a href="{{asset('uploads/fullPhotoCars/'.$driverOffer->thumbnail)}}" data-fancybox="gallery">
                    <img src="{{asset('uploads/fullPhotoCars/'.$driverOffer->thumbnail)}}" class="img-fluid rounded" alt="" style = "width:475px;">
                </a>



                </div>

                <div class="col-md-7">

                    <div class="row">

                        <div class="col-md-6">
                            <div >Город: {{$offerInfo['cityName']}}</div>


                            <div>Длина:{{$driverOffer->internal_length}} м.</div>
                            <div>Ширина:{{$driverOffer->internal_width}} м.</div>
                            <div>Высота:{{$driverOffer->internal_height}} м.</div>

                            <div>Дата: {{$driverOffer->created_at->format('Y-m-d')}}</div>


                        </div>


                        <div class="col-md-6">
                            <div>Телефон: {{$offerInfo['phone']}}</div>
                            <div>Цена за 1 км: {{$driverOffer->price_per_km}} грн</div>
                            <div>Тип грузов:
                            @foreach($driverOffer->types as $type)
                                {{$type->type_name}}
                            @endforeach
                            </div>
                            <div>Тип транспорта: {{$driverOffer->carType->name_car_type}}</div>
                            <div>Грузоподъемность:{{$driverOffer->weight}} тонн(ы)</div>

                        </div>

                    </div>



                </div>

            </div>
            <br>
            <div class="text-right">


                @role('customer')
                    <button class="btn btn-primary"  onclick="sendMessage({{$driverOffer->id}},{{$driverOffer->driver_id}})">Предложить</button>
                @endrole
            </div>
            <hr>

            <div class="row d-flex justify-content-left">


                <div class="col-md-10 text-left">

                    <h4 class="h4">Описание</h4>

                    <p>{{$driverOffer->description}}</p>

                </div>

            </div>


            {{--Modal Window--}}
            @role('customer')
            <div id = "sendMessageModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Предложить работу</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id = "sendMessageForm">
                            <div class="modal-body">
                                <div class="success-message">

                                </div>
                                <input type="hidden" name="offer_id">


                                <input type="hidden" name='type' value="DriverOffer">
                                <div class="form-group">
                                <legend>Веберите одно из своих объявлений</legend>

                                <select class="offer form-control" name = 'customer_offer_id'>
                                    @foreach($customerOffer as $offer)
                                        <option value="{{$offer->id}}" >{{$offer->title}}</option>
                                        @endforeach
                                </select>

                                <br>

                                    <label>Описание</label>
                                    <textarea class="form-control" name="description"></textarea>

                                    <span class="invalid-feedback" role="alert">
                                    Ошибка отправки
                                </span>

                                </div>






                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Отправить</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
          {{--Modal Window--}}
            @endrole


            <div>
                <br>

                <hr>
                @if($dialogs->count()>1)
                    <h3>Все Отклики</h3>
                    <br>
                    <div class="row">

                        @foreach($dialogs as $dialog)
                            <div class="col-md-6 my-offer">
                                <div class="card shadow-lg rounded">
                                    <div class="row">
                                        <div class="col-md-2 offer-part">
                                            <img class = 'img-fluid' src="{{'/uploads/thumbnails/'.$dialog->user->thumbnail}}" >
                                        </div>
                                        <div class="col-md-5 text-left">

                                            {{$dialog->user->name}}
                                            <br>
                                            <a href="{{route('dialogs.show',['dialog'=>$dialog->id])}}">Посмотреть отклик</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h3>Нет откликов</h3>
                @endif

            </div>

        </div>



    </main>





@endsection



@section('scripts')
    <script src="{{asset('/js/main.js')}}"></script>
    <script src="{{asset('/js/sender.js')}}"></script>
    <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>
@endsection
