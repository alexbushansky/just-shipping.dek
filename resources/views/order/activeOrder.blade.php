@extends('layouts.menu')
@section('styles')

    <link rel="stylesheet" href="{{asset('fancy-box/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/order/driver/active-order-driver.css')}}">
@endsection

@section('content')


    <div class="container">
        @if($orders->count()>0)
        <h2>Активные Заказы</h2>
        <div class="row">

            @foreach($orders as $order)
            <div class="col-md-12">

                <div class="card">
                    <div class="row">

                        <div class="col-md-4">
                                <img class = 'img-fluid' src="{{'/uploads/customerThumbnailPhoto/'.json_decode($order->gallery)[0]}}" alt="">
                        </div>

                        <div class="col-md-7">
                            <div class="card-block">
                                <br>
                                <h4 class="card-title">{{$order->title}}</h4>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div>{{$order->fullAddressFrom->city->name}}</div>
                                        <div>{{$order->fullAddressTo->city->name}}</div>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-3">
                                        <div>Вес: {{$order->weight}} кг</div>
                                        <div>Цена за 1 км: {{$order->price_per_km}} грн</div>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-3">
                                        @role('driver')
                                        <div>Заказчик: <a href="{{route('guest-room',['id'=>$order->customer->user->id])}}">{{$order->customer->user->name}}</a></div>
                                        @endrole
                                        @role('customer')
                                        <div>Перевозчик: <a href="{{route('guest-room',['id'=>$order->driver->user->id])}}">{{$order->driver->user->name}}</a></div>
                                        @endrole
                                        <div>Дата: {{$order->date_finish}} </div>
                                        <br>

                                        <a href="{{route('showActiveOrder',['id'=>$order->id])}}" type="submit" class="btn btn-sm btn-primary">Подробнее</a>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                    <br>
            </div>



            @endforeach

        </div>
        @else
            <h3>У вас нет активных заказов</h3>
        @endif
    </div>


@endsection
@section('scripts')

    <script src="{{asset('fancy-box/jquery.fancybox.min.js')}}"></script>
@endsection
