function codeAddress() {

    var countryOne =$( "#countryOne option:selected" ).text();
    var regionOne =$( "#regionOne option:selected" ).text();
    var cityOne =$( "#cityOne option:selected" ).text();
    var streetOne =$( "#streetOne" ).val();
    var houseOne =$( "#houseOne" ).val();
    var addressOne = countryOne +','+regionOne+','+cityOne+','+streetOne+' '+houseOne;
    var countryTwo =$( "#countryTwo option:selected" ).text();
    var regionTwo =$( "#regionTwo option:selected" ).text();
    var cityTwo =$( "#cityTwo option:selected" ).text();
    var streetTwo =$( "#streetTwo" ).val();
    var houseTwo =$( "#houseTwo" ).val();
    var addressTwo = countryTwo +','+regionTwo+','+cityTwo+','+streetTwo+' '+houseTwo;
    console.log(addressOne);
    var geocoder = new google.maps.Geocoder();
    var flag = false;
    geocoder.geocode( { 'address': addressOne}, function(results, status) {
        if (status == 'OK') {
            var marker = new google.maps.Marker({
                position: results[0].geometry.location
            });

            var latOne = marker.position.toJSON().lat;
            if(latOne == 50.0529506)
            {
                latOne ==50.45466;
            }
            var lngOne = marker.position.toJSON().lng;

            if(lngOne == 30.7667134)
            {
                lngOne ==30.5238;
            }
            addressOne ='{"lat":'+latOne+', "lng":'+lngOne+'}'
            $('#addressOne').val(addressOne);

            flag = true;
            geocoder.geocode( { 'address': addressTwo}, function(results, status) {
                if (status == 'OK') {
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location
                    });

                    var latTwo = marker.position.toJSON().lat;
                    if(latTwo == 50.0529506)
                    {
                        latTwo ==50.45466;
                    }
                    var lngTwo = marker.position.toJSON().lng;
                    if(lngTwo == 30.7667134)
                    {
                        lngTwo ==30.5238;
                    }
                    addressTwo = '{"lat":'+latTwo+', "lng":'+lngTwo+'}'
                    console.log(marker.position.toJSON())
                    $('#addressTwo').val(addressTwo);
                    flag = true;
                    if (flag==true)
                    {
                    $('.red').addClass('hide')
                    $('.green').toggleClass('hide')
                    $('.addressOne').toggleClass('hide')
                    $('.addressOne').addClass('show')
                    $('.addressTwo').toggleClass('hide')
                    }

                } else {
                    alert('Ошибка ввода ');
                    flag = false;
                    $('.green').addClass('hide')
                    $('.red').toggleClass('hide')
                }
            });
        } else {
            alert('Ошибка ввода ');
            $('.green').addClass('hide')
            $('.red').toggleClass('hide')
            flag = false;
        }
    });

}
