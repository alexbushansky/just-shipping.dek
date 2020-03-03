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
                    <input class="form-control" type="text" placeholder="Поиск" name="title">
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
    @if($customerOffers->count() > 0 )


        {{$customerOffers->links()}}
        @else
        <br>
        <h4>По вашому запросу ничего не найдено</h4>

    @endif
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
    </script>
@endsection


