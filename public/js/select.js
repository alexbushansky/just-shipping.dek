

$(document).ready(getLocation('.select-country','.select-region','.select-city'));

$(document).ready(getLocation('.select-country-two','.select-region-two','.select-city-two'));



function getLocation(country,region,city){
    $.ajax({
        url: "/geonames/countries",
        type: 'GET',
       contentType: 'application/json; charset=utf-8',
        success: function (data) {
            country = $(country);
            region = $(region);
            city = $(city);

            country.append('<option value="">Выберите страну</option>');

            $.each(data.countries,function (key,value) {
                country.append('<option value="'+value.id+'">'+value.name+'</option>');

            });

            country.change(function(){
                city.html('');
                region.html('');
                var countryId = $(this).children("option:selected").val();
                    $.ajax({
                        url: '/geonames/regions/' + countryId,
                        type: 'GET',
                        contentType: 'application/json; charset=utf-8',
                        success:function (data) {

                            region.append('<option value="">Выберите регион</option>');
                            $.each(data.regions,function (key,value) {

                                region.append('<option value="'+value.id+'">'+value.name+'</option>');

                            });

                            region.change(function(){
                                city.html('');
                                var regionId = $(this).children("option:selected").val();
                                $.ajax({
                                    url: '/geonames/cities/' + regionId,
                                    type: 'GET',
                                    contentType: 'application/json; charset=utf-8',
                                    success:function (data) {

                                        city.append('<option value="">Выберите город</option>');
                                        $.each(data.cities,function (key,value) {

                                            city.append('<option value="'+value.id+'">'+value.name+'</option>');

                                        });

                                    }
                                })
                            });

                        }
                    })
            });


        },
        error: function () {

        }
    });
}


