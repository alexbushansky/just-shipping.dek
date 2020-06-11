@extends('layouts.menu')

@section('styles')

    <link rel="stylesheet" href="{{asset('css/offer/offer.css')}}">
@endsection

@section('content')

    <div class="container">
    <div class="container-fluid">

        <div>
            <div class="row head">


                <div class="col-md-6">
                    <h4>Вы предложили</h4>
                </div>
                <div class="col-md-6">
                <div class="col-md-6">
                    <div class="col-md-6 text-center"><h4><a class="badge badge-success" href="{{route('showOfferDialogs')}}">Вам предложили</a></h4></div>

                </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">

            <div class="col-md-6">
                <h5><strong>Рассматриваются</strong></h5>
                <br>
                <ul class="list-group">

                @foreach($offers as $offer)
                    @if($offer->status_dialog_id ==1)
                        <li class="list-group-item">


                            <div class="row">
                                <div class="col-md-2">ID:   <strong>{{$offer->id}}</strong></div>
                                <div class="col-md-5">
                                    @if($offer->offer_type == 'App\Models\DriverOffer')
                                        Посмотреть <a href="{{route('driver-offers.show',['driverOffer'=>$offer->offer_id])}}">заказ</a>
                                    @else
                                        Посмотреть <a href="{{route('customer-offers.show',['customerOffer'=>$offer->offer_id])}}">заказ</a>
                                        <br>
                                    @endif</div>
                                <div class="col-md-5">Посмотреть<a  href="{{route('dialogs.show',['dialog'=>$offer->id])}}"> диалог</a></div>
                            </div>

                        </li>
                    @endif

                @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h5><strong>В процессе выполнения</strong></h5>
                <br>
                <ul class="list-group">

                    @foreach($offers as $offer)
                        @if($offer->status_dialog_id == 2)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2">ID:   <strong>{{$offer->id}}</strong></div>

                                    @if($offer->offer_type == 'App\Models\DriverOffer')
                                        <div class="col-md-5">Посмотреть <a href="{{route('showActiveOrder',['id'=>$offer->customer_offer_id])}}">заказ</a></div>
                                    @else
                                        <div class="col-md-5">Посмотреть <a href="{{route('showActiveOrder',['id'=>$offer->offer_id])}}">заказ</a></div>
                                        <br>
                                    @endif

                                    <div class="col-md-5">Посмотреть<a  href="{{route('dialogs.show',['dialog'=>$offer->id])}}"> диалог</a></div>





                                </div>
                            </li>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
