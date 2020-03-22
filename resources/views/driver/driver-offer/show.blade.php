@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">


@endsection









@section('content')

    @php

        $isAdmin= auth()->user()->isAdmin();
        $isCustomer= auth()->user()->isCustomer();
        $isDriver= auth()->user()->isDriver();

    @endphp
    <main>

        <div class="container dark-grey-text mt-4">


            <h3>{{$driverOffer->title}}</h3>

            <br>

            <div class="row">


                <div class="col-md-5">

                    <img src="{{asset('uploads/fullPhotoCars/'.$driverOffer->thumbnail)}}" class="img-fluid rounded" alt="" style = "width:475px;">
{{--                    <img src="{{asset('img/bd4c5cac0b82cac5f99f8097fa1f1a80.jpg')}}" class="img-fluid" alt="">--}}



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
                            <div>Телефон</div>
                            <div>Цена за 1 км: {{$driverOffer->price_per_km}} грн</div>
                            <div>Типы грузов</div>
                            <div>Грузоподъемность:{{$driverOffer->max_weight}} тонн(ы)</div>

                        </div>

                    </div>




                </div>

            </div>
            <br>
            <div class="text-right">

                @if($isAdmin || $isCustomer)
                    <button class="btn btn-primary"  onclick="sendMessage({{$driverOffer->id}},{{$driverOffer->driver_id}})">Предложить</button>
                @endif
            </div>
            <hr>

            <div class="row d-flex justify-content-left">




                <div class="col-md-10 text-left">

                    <h4 class="h4">Описание</h4>

                    <p>{{$driverOffer->description}}</p>

                </div>

            </div>


            {{--Modal Window--}}
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
                                <input type="text" name="offer_id">


                                <input type="text" name='type' value="DriverOffer">



                                <div class="form-group">
                                    <label>Написать отклик</label>
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

            @if($isAdmin || $isCustomer)
            <div>
                <br>
                <h3>Все отклики</h3>

                    @if($dialogs)
                        @foreach($dialogs as $dialog)
                            <div>
                                {{$dialog->user->name}}
                                <a href="{{route('dialogs.show',['dialog'=>$dialog->id])}}">Посмотреть отклик</a>
                            </div>
                        @endforeach
                    @endif

            </div>
            @endif
        </div>


    </main>





@endsection



@section('scripts')
    <script src="{{asset('/js/main.js')}}"></script>
    <script src="{{asset('/js/sender.js')}}"></script>
@endsection
