@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
@endsection

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 filter">

                <br>

                <form method="get" action="{{route('driver-offers.index')}}">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Поиск" name="title" value="{{request()->query('title')}}">
                    </div>

                    <fieldset>
                        <legend>Country</legend>
                        <select id="select_countries" class="form-control" name="country_id">
                            <option disabled>Выберите страну</option>
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>Region</legend>
                        <select id="select_regions" class="form-control" name="region_id">
                            <option disabled>Выберите регион</option>
                        </select>
                    </fieldset>

                    <fieldset>

                        <legend>City</legend>
                        <select id="select_cities" class="form-control" name="city_id">
                            <option disabled>Выберите город</option>
                        </select>
                    </fieldset>
                    <span class="form-group">
                        <button class="btn btn-sm btn-primary" type="submit">{{__('Submit')}}</button>
                    </span>

                    <span class="form-group">
                        <button class="btn btn-sm btn-danger" type="reset">{{__('Reset')}}</button>
                    </span>
                </form>


            </div>

            <div class="col-md-9">
                    @if($driverOffers->count() > 0 )



                        @foreach($driverOffers as $offer)


                                <div class="card">
                                    <img src="#" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <ul>
                                            <li><i class="fas fa-map-marker-alt"></i> {{$offer->city->name}}</li>
                                            <li><i class="fas fa-city"></i>  {{$offer->title}}</li>
                                            <li><i class="fas fa-user"></i> Заказчик: User123</li>
                                            <li><i class="fas fa-box-open"></i> Тип груза: Общий</li>
                                            <li><i class="fas fa-hryvnia"></i> Цена за 1 км: 200 грн</li>
                                            <button class="btn btn-primary"  onclick="sendMessage({{$offer->id}},{{$offer->driver_id}})">Заказать</button>

                                        </ul>
                                    </div>
                                </div>


                        @endforeach
                        {{$driverOffers->links()}}

                    @else
                        <br>
                        <h4>По вашому запросу ничего не найдено</h4>

                    @endif
            </div>

            <div id = "sendMessageModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id = "sendMessageForm">
                        <div class="modal-body">

                            <input type="text" name="offer_id">
                            <input type="text" name="driver_id">
                            <div class="form-group">
                                <label>Описание</label>
                            <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection





@section('scripts')

    <script src="{{asset('/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/select2/js/i18n/ru.js')}}"></script>
    <script>
        $(function(){
            var selectRegions, selectCountries, selectCity;
            // INIT SELECT2 USING  AJAX DATA
            $.ajax({
                url: '/geonames/countries',
                type: 'GET',
                contentType: 'application/json; charset=utf-8'
            }).then(function (response) {



                var data = response.countries.map(function (item) {
                    return {id: item.id, text: item.name};
                });

                selectCountries = $('#select_countries').select2({
                    language: "ru",
                    data: data
                });



                $('#select_countries').on("select2:select" ,function (event) {
                    $("#select_cities").empty();

                    var countryId = event.params.data.id;
                    console.log(countryId);
                    // INIT SELECT2 USING  AJAX DATA
                    $.ajax({
                        url: '/geonames/regions/' + countryId,
                        type: 'GET',
                        contentType: 'application/json; charset=utf-8'
                    }).then(function (response) {

                        $("#select_regions").empty();

                        var data = response.regions.map(function (item) {
                            return {id: item.id, text: item.name};
                        });



                        selectRegions = $('#select_regions').select2({
                            language: "ru",
                            data: data,

                        });




                        $('#select_regions').on("select2:select", function (event) {

                            var regionId = event.params.data.id;
                            $.ajax({
                                url: '/geonames/cities/' + regionId,
                                type: 'GET',
                                contentType: 'application/json; charset=utf-8'
                            }).then(function (response) {


                                $("#select_cities").empty();


                                var data = response.cities.map(function (item) {
                                    return {id: item.id, text: item.name};
                                });
                                console.log(data);


                                selectCity = $('#select_cities').select2({
                                    language: "ru",
                                    data: data,

                                });

                            });


                        });


                    });
                });
            });


            $('.select2-basic').select2();
        });


        function sendMessage(offerId,driverId) {
            var form =$('#sendMessageModal');
            form.find('input[name="driver_id"]').val(driverId);
            form.find('input[name="offer_id"]').val(offerId);
            console.log(offerId,driverId);

            $('#sendMessageModal').modal('show');

        }
    </script>
@endsection


