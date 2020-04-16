@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/dialog.css')}}">
    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">
@endsection

@section('content')
@php
    $user = auth()->user();
@endphp

    <div class="container py-2 px-4 message-box">
        <h3 class="text-center">Диалог</h3>
        <div class="row">
            <!-- Chat Box-->
            @if($customerOffer)
            <div class="col-6 px-0">
                @else
                    @role('customer')
                    <div class="col-10 px-0">
                    @else
                    <div class="col-12 px-0">
                    @endrole
            @endif
                <div class="px-3 py-5 chat-box bg-white overflow-auto my-container">

                    @if($messages)
                        @foreach($messages as $message)

                            @if($message->user_id == $user->id)
                                <div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-info rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white"> {{$message->message_text}}</p>
                                        </div>
                                        <p class="small text-muted">{{$message->created_at->format('Y-m-d | H:i')}}</p>

                                    </div>
                                </div>
                            @else
                                <div class="media w-50 mb-3"><img src="{{asset('uploads/thumbnails/'.$message->user->thumbnail)}}" alt="user" class="rounded-circle img-fluid dialog-img">
                                    <div class="media-body ml-3">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted">{{$message->message_text}}</p>
                                            <p class="small text-muted"> <strong><a href="{{route('guest-room',['id'=>$message->user->id])}}">{{$message->user->name}}</a></strong></p>
                                        </div>

                                        <p class="small text-muted">{{$message->created_at->format('Y-m-d | H:i')}}</p>

                                    </div>
                                </div>

                        @endif
                        @endforeach
                        @endif



                </div>

                <!-- Typing area -->
                <form  id = "chatForm" class="bg-light">
                    @csrf
                    <input name="dialog_id" type="hidden" value="{{$dialog->id}}">

                    <div class="input-group">
                        <input type="text"  id ='message_text' name="message_text" autocomplete="off" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light @error('message_text') is-invalid @enderror">
                        @error('message_text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">

                            <input type="submit" class="btn btn-link" name="Отправить">
                        </div>
                    </div>
                </form>
            </div>
            @if($customerOffer)
                <div class="col-6 bg-white left-window">
                    <br>
                    <div class="row">
                    <div class="col-12 text-center">
                        <h3>{{$customerOffer->title}}</h3>

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-9">
                        <a data-fancybox="gallery" href="{{'/uploads/fullCustomerPhoto/'.json_decode($customerOffer->gallery)[0]}}">
                            <img class = 'img-fluid rounded' src="{{'/uploads/fullCustomerPhoto/'.json_decode($customerOffer->gallery)[0]}}">
                        </a>
                    </div>

                        <div class="col-md-12">
                            <br>

                            <div class="row">
                            <div class="col-md-6" >
                                <ul>
                               <li><strong>Откуда : </strong> {{$customerOffer->addressFrom->country->name}},{{$customerOffer->addressFrom->city->name}}</li>
                                    <li><strong>Куда : </strong>{{$customerOffer->addressTo->country->name}},{{$customerOffer->addressTo->city->name}}</li>
                                    <li><strong>Цена за 1 км: </strong>{{$customerOffer->price_per_km}} грн</li>
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
                            <br>
                            @if($customerOffer->status_id == 1)
                           @role('driver')
                            <div class="row">

                                <div class="col-md-6"> <a class="btn btn-info" href="{{route('customer-offers.show',['customerOffer'=>$customerOffer->id])}}">Детальнее</a></div>

                                <div class="col-md-6">
                                    <form action="{{route('acceptCustomerOffer',['id'=>$customerOffer->id])}}" method="POST">
                                        @csrf
                                    <button type="submit" class="btn btn-success" href="">Принять заказ</button>

                                    <input type="hidden" value="{{$dialog->offer_id}}" name="driverOfferId">
                                    <input type="hidden" value="{{$user->driver->id}}" name="driverId">
                                    <input type="hidden" value="{{$dialog->id}}" name="dialogId">

                                 </form>
                                </div>
                            </div>
                            @endrole
                                @endif
                        </div>
                    </div>
                </div>
                @else

                @role('customer')
                        <div class="col-2 bg-white left-window text-justify">
                            <div>
                                <form action="{{route('acceptCustomerOffer',['id'=>$dialog->offer_id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-primary">Сделать перевозчиком</button>
                                    <input type="hidden" value="{{$dialog->getDriver($dialog->user_id)->id}}" name="driverId">
                                    <input type="hidden" value="{{$dialog->id}}" name="dialogId">
                                </form>
                            </div>
                        </div>
                @endrole

        @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/moment/moment.js')}}"></script>
    <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('js/chat/chat.js')}}"></script>
    <script>
        showMessages({{$dialog->id}},@json($user));
        $(".my-container").animate({scrollTop: ($(".my-container").prop('scrollHeight'))}, 1500);
    </script>
@endsection
