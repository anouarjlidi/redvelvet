function myMap()
{
    var myLatLng = {lat: 55.726580, lng: 24.362432};

    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 15,
        draggable:false,
        mapTypeId: google.maps.MapTypeId.roadmap
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Red Velvet',
        icon: "img/icon.jpg",
        animation: google.maps.Animation.DROP
    });
}