@extends('layouts.menu')


@section('styles')

    <link rel="stylesheet" href="/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/css/myStyle/range.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/driver-offer.css')}}">
@endsection

@section('content')


    <div class="container-fluid bg-light py-3 my-main">
        <div class="row my-main">
            <div class="col-md-5 mx-auto">
                <div class="card card-body">
                    <form  action="{{route('driver-offers.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <h3 class="text-center mb-4">Добавить предложение</h3>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Кратко" name="nameOfOrder" type="text">
                        </div>

                        <div class="form-group">
                            <legend>Веберите средство перевозки</legend>
                            <select class="form-control" name="driverCar">
                                @foreach($driverCar as $car)
                                    <option value="{{$car->car_id}}">
                                        {{$car->model_of_car}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select id = "types" class="js-example-basic-multiple js-states form-control"  multiple="multiple" name = 'types[]'>

                            </select>
                        </div>
                        <div class="form-group">
                            <select  class="form-control select-country" name="country">

                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control select-region" name="region">

                            </select>
                        </div>
                        <div class="form-group">
                            <select  class="form-control select-city" name = 'city'>

                            </select>
                        </div>



                        <div class="form-group">
                            <legend>Цена за 1 км</legend>
                            <div class="slidecontainer">
                                <div class="showPrice">0</div>
                                <input type="range" min="0" step = '10' max="2000" value="0" class="slider" name = "price_per_km">
                            </div>
                        </div>

                        <div class="form-group">
                        Параметры груза
                        </div>

                        <br>
                        <div class="row">

                            <div class="col">
                                <input type="number" class="form-control"  min="0" placeholder="Макс. куб" name="capacity">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control"  min="0" placeholder="Макс. вес (кг)" name="weight">
                            </div>

                        </div>
                        <br>



                        <br>
                        <div class="form-group">
                            <label for="describe">Описание:</label>
                            <textarea class="form-control" rows="5" id="describe" name="description"></textarea>
                        </div>



                        <input type="hidden" value="{{$driverId}}" name="driver_id">



                        <input class="btn btn-primary btn-block" value="Добавить" type="submit">
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>








@endsection

    @section('scripts')
         <script src="{{asset('/select2/js/select2.min.js')}}"></script>
         <script src="{{asset('/select2/js/i18n/ru.js')}}"></script>
         <script src = "{{asset('/js/selectTypes.js')}}"></script>
         <script src = "{{asset('/js/select.js')}}"></script>
         <script src="{{asset('/js/range.js')}}"></script>
         <script>
             // Add the following code if you want the name of the file appear on select
             $(".custom-file-input").on("change", function() {
                 var fileName = $(this).val().split("\\").pop();
                 $(this).siblings(".custom-file-label").addClass("selected").html(fileName.slice(0,20));
             });
         </script>
    @endsection
