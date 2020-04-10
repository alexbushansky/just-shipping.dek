

@extends('layouts.menu')


@section('styles')

    <link rel="stylesheet" href="/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('css/myStyle/car/create.css')}}">



@endsection

@section('content')


    <div class="container-fluid bg-light py-3 my-main">
        <div class="row my-main">
            <div class="col-md-5 mx-auto">
                <div class="card card-body">
                    <form  action="{{route('driver-car.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center mb-4">Добавить транспорт</h3>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Модель" name="modelOfCar" type="text">
                            </div>

                            <div class="form-group">
                                <select id = "carTypes" class="form-control js-car-type" name="carType">
                                    <option></option>
                                </select>
                            </div>





                            <div class="form-group">
                                Параметры средства перевозки
                            </div>
                            <div class="row">

                                <div class="col">
                                    <input type="number" class="form-control" min="0" placeholder="Ширина (м)" name = 'internal_width'>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control"  min="0" placeholder="Высота (м)" name = 'internal_height'>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" min="0" placeholder="Длина (м)" name="internal_length">
                                </div>
                            </div>

                            <br>
                            <div class="row">

                                <div class="col">
                                    <input type="number" class="form-control"  min="0" placeholder="Вместимость (куб)" name="max_capacity">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control"  min="0" placeholder="Макс. вес (кг)" name="max_weight">
                                </div>

                            </div>
                            <br>
                            <div class="form-group custom-file w-100 text-left">
                                <input type="file" class="custom-file-input" id="customFile" name="photo">
                                <label class="custom-file-label" for="customFile">Фото транспорта</label>
                            </div>

                                <br>
                                <br>
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


    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName.slice(0,20));
        });
    </script>
@endsection
