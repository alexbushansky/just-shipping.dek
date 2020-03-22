


    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-car-type').select2();
    });



$(document).ready(function () {
    $.ajax({
        url: "/get-cargo-types",
        type: 'GET',
        contentType: 'application/json; charset=utf-8',
        success: function (data) {

            $.each(data.types,function (key,value) {
                console.log(value);
                $('#types').append('<option value="' + value.id + '">' + value.type_name + '</option>');
            });
            $(".js-example-basic-multiple").select2({
                placeholder: "Выберите тип груза",
            });
        }
    })
});



    $(document).ready(function () {
        $.ajax({
            url: "/get-car-types",
            type: 'GET',
            contentType: 'application/json; charset=utf-8',
            success: function (data) {

                $.each(data.carTypes,function (key,value) {
                    console.log(value);
                    $('#carTypes').append('<option value="' + value.id + '">' + value.name_car_type + '</option>');
                });
                $(".js-car-type").select2({
                    placeholder: "Выберите тип транспорта",
                    allowClear: true
                });
            }
        })
    });
