@extends('admin.devApp')

@section('title','All Cars types')

@section('content')
@php
    $locale=devApp()->getLocale();
@endphp
<div class="col-12">

    <div class="card">
        <div class="card-body">
            @if($carTypes->count() > 0)

            <table class="table table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th>{{__('admin.id')}}</th>
                    <th>{{__('admin.name')}}</th>
                    <th width="120">{{__('admin.action')}} </th>

                </tr>
                </thead>

                <tbody>
                @foreach($carTypes as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name_car_type}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('car-types.edit',['carType'=>$item->id])}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

{{--                            <form>--}}
{{--                            <a class="btn btn-sm btn-danger" type="button" href="{{route('car-types.destroy',['carType'=>$item->id])}}">--}}
{{--                                <i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                            </a>--}}
{{--                            </form>--}}

                            <form class="d-inline-block" method="post" action ="{{route('car-types.destroy', ['carType' =>$item->id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn  btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
                {{$carTypes->links()}}
                @else
            <h4>По данному запросу ничего не найдено</h4>
                @endif




        </div>
    </div>
</div>

@endsection
