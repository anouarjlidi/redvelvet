function myMap()
{
    var myLatLng = {lat: 55.729554, lng: 24.361941};

    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.roadmap
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Red Velvet',
        animation: google.maps.Animation.DROP
    });
}