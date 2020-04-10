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
            <div class="row">
                <div class="col-md-12">
                @foreach($offers as $offer)

                   <div class="col-md-4"><a href="{{route('dialogs.show',['dialog'=>$offer->id])}}">{{$offer->id}}</a></div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
