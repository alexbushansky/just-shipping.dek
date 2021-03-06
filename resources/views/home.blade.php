@extends('layouts.menu')

@section('content')
    @php
        $locale = App()->getLocale();
    @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach (auth()->user()->roles as $role)
                            <div>{{$role->$locale}}</div>
                            @endforeach


                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
