@extends('layouts.menu')
@section('styles')

@endsection


@section('content')

    <div class="container">
        @if($orders->count()>0)
            <h2>Выполненные <заказы></заказы></h2>
            <div class="row">

                @foreach($orders as $order)
                    {{$order->title}}
                @endforeach
        @else
            <h3>Нет выполненных заказов</h3>
        @endif
    </div>
@endsection
