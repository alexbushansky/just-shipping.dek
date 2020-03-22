@extends('layouts.menu')


@section('styles')

    <link rel="stylesheet" href="/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/css/myStyle/range.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/createCustomerOffer.css')}}">

@endsection

@section('content')


    <div class="container-fluid bg-light py-3 my-main">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card card-body">
                    <form  action="{{route('customer-offers.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center mb-4">Добавить заказ</h3>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Название" name="nameOfOrder" type="text">
                            </div>
                            <div class="form-group">
                                <select id = "types" class="js-example-basic-multiple js-states form-control"  multiple="multiple" name = 'types[]'>

                                </select>
                            </div>

                            <div class="form-group">
                                <a class="text-decoration-none nav-link my-addOne" href="#">Адресс Отправки</a>

                                <ul class="addressOne hide">
                                    <li>
                                        <div class="form-group">
                                            <select class="form-control select-country" name="country_one">

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <select  class="form-control select-region" name="region_one">

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <select  class="form-control select-city" name = 'city_one'>

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                           <input class="form-control street-input"  type="text" placeholder="Улица" name="street_one">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input class="form-control house-input" type="text" placeholder="Дом" name="house_one">
                                        </div>

                                    </li>
                                </ul>

                            </div>



                            <div class="form-group">
                                <a class="text-decoration-none nav-link my-addTwo" href="#">Адресс Доставки</a>
                                <ul class="addressTwo hide">
                                    <li>
                                        <div class="form-group">
                                            <select class="form-control select-country-two" name="country_two">

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <select  class="form-control select-region-two" name="region_two">

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <select  class="form-control select-city-two" name = 'city_two'>

                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input class="form-control street-input"  type="text" placeholder="Улица" name="street_two">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input class="form-control house-input" type="text" placeholder="Дом" name="house_two">
                                        </div>

                                    </li>
                                </ul>

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
                                    <input type="number" class="form-control"  min="0" placeholder="Колл-во кубов" name="capacity">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control"  min="0" placeholder="Масса груза" name="weight">
                                </div>

                            </div>
                            <br>
                            <div class="form-group custom-file w-100 text-left">
                                <input type="file" name="photo[]" class="custom-file-input" id="customFile"  multiple="">
                                <label class="custom-file-label" for="customFile">Фото Груза</label>
                            </div>
                            <br>
                            <br>
                            <div class="form-group w-100">
                                <label for="example-date-input" class="col-form-label">Актуально до</label>

                                    <input class="form-control" type="date" id="example-date-input" name="date_finish">

                            </div>
                            <div class="form-group">
                                <label for="describe">Описание:</label>
                                <textarea class="form-control" rows="5" id="describe" name="description"></textarea>
                            </div>



                            <input type="hidden" value="{{$customerId}}" name="customer_id">



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
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $(function() {
            $('.my-addOne').on('click', function(e) {
                e.preventDefault();
                $('.addressOne').toggleClass('hide');
            });
        });
        $(function() {
            $('.my-addTwo').on('click', function(e) {
                e.preventDefault();
                $('.addressTwo').toggleClass('hide');
            });
        });
    </script>


@endsection
