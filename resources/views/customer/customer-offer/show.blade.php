@extends('layouts.menu')






@section('styles')

    <link rel="stylesheet" href="{{asset('css/myStyle/customerOfferShow.css')}}">
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">




@endsection



@section('content')



      <div class="container">


            <h2>{{$customerOffer->title}}</h2>


            <br>

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
                                <li><strong>Откуда : </strong> {{$customerOffer->fullAddressFrom->country->name}}, {{$customerOffer->fullAddressFrom->city->name}}</li>
                                <li><strong>Куда : </strong> {{$customerOffer->fullAddressTo->country->name}}, {{$customerOffer->fullAddressTo->city->name}}</li>

                                <li><strong>Цена за 1 км: </strong>{{$customerOffer->price_per_km}} грн</li>
                                <li><strong>Объем: </strong>{{$customerOffer->capacity}} м3</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li><strong>Октуально до: </strong>{{$customerOffer->date_finish}}
                                <li><strong>Тип груза: </strong>
                                    @foreach($customerOffer->cargoType as $type)
                                        {{$type->type_name}}
                                    @endforeach</li>
                                <li><strong>Вес: </strong>{{$customerOffer->weight}} кг</li>
                            </ul>
                        </div>
                    </div>




                </div>

            </div>
            <div class="text-right">

                @role('driver')
                <button class="btn btn-primary" onclick="sendMessage({{$customerOffer->id}},{{$customerOffer->customer_id}})">Взять заказ</button>
                @endrole
            </div>
            <br>

            <hr>

            <div class="row d-flex justify-content-left">


                <div class="col-md-10 text-left">

                    <h4 class="h4">Описание</h4>
                    {{$customerOffer->description}}
                </div>

            </div>


            @role('driver')
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
                                <input type="hidden" name = 'recipient_id' value="{{$user->id}}">

                                <input type="hidden" name='type' value="CustomerOffer">

                                <div class="form-group">
                                    <br>
                                    <label>Сообщение</label>
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
            @auth
                @if($dialogs->count()>0)
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
                              <a class="small text-muted">{{$dialog->created_at->format('Y-m-d | h:m')}}</a>
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
            @endauth
            </div>
        </div>






@endsection



@section('scripts')
        <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>
        <script src="{{asset('js/customer/sendMessage.js')}}"></script>
        <script>
            $('[data-fancybox="preview"]').fancybox({
                thumbs : {
                    autoStart : true
                }
            });
        </script>
@endsection
