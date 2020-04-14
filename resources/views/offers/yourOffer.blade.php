@extends('layouts.menu')

@section('styles')


@endsection

@section('content')

    <div class="container">
    <div class="container-fluid">

        <div>
            <div class="row">
                <div class="col-md-6 text-center"><a href="{{route('showDialogs')}}">Вы предложили</a></div>
                <div class="col-md-6 text-center"><a href="{{route('showOfferDialogs')}}">Вам предложили</a></div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                @foreach($offers as $offer)

                        <div class="col-md-6">

                            @if($offer->dialogable_type == 'App\Models\DriverOffer')

                            @else
                                Посмотреть <a href="{{route('customer-offers.show',['customerOffer'=>$offer->dialogable_id])}}">заказ</a>
                                <br>
                            @endif
                                Посмотреть<a href="{{route('dialogs.show',['dialog'=>$offer->id])}}"> диалог</a>

                        </div>


                @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
