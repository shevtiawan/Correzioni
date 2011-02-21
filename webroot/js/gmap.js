function initialize(container, lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    var myOptions = {
        zoom: 8,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(container), myOptions);
}

