var directionsService = new google.maps.DirectionsService();

var directionsDisplay = new google.maps.DirectionsRenderer();

geo = new google.maps.Geocoder();

var myOptions = {
    zoom:7,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("map"), myOptions);
directionsDisplay.setMap(map);



var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
    transit_mode: bus,
};







function direction(latFrom,lngFrom,latTo,lngTo,price) {



    var st=new google.maps.LatLng(latFrom, lngFrom);

    var en=new google.maps.LatLng(latTo, lngTo);

    var request = {
        origin: st,
        destination:en,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        transit_mode: bus,
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {



            var distance = (response.routes[0].legs[0].distance.value)/1000;
            // Display the distance:
            distance =  distance.toFixed(1);
            document.getElementById('distance').innerHTML +=
                distance + " км";

            document.getElementById('price').innerHTML +=distance * price + 'грн';


            var hours = response.routes[0].legs[0].duration.value/60/60;

            // Display the duration:
            document.getElementById('duration').innerHTML +=
                hours.toFixed(1) + "  часов";




            directionsDisplay.setDirections(response);
        }
    });

}
