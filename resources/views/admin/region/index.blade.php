<?php
@extends('admin.devApp')

@section('title','All Region')
@php
    $locale=devApp()->getLocale();
@endphp

@section('content')


    <div class="col-12">

        <div class="card">
            <div class="card-header">Card title</div>
            <div class="card-body">
                @if($carTypes->count() > 0)

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                            <th>{{__('admin.id')}}</th>
                            <th>{{__('admin-city.name')}}</th>
                            <th>{{__('admin-city.country')}}</th>
                            <th width="120">{{__('admin.action')}} </th>

                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->$locale}}</td>
                            <td> --</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="#">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>

                                <a class="btn btn-sm btn-danger" type="button" href="#">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>


                            </td>
                        </tr>


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
