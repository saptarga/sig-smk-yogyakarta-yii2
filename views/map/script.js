(function ($) {
	var a = parseFloat($("#latitude").val());
	var b = parseFloat($("#longtitude").val());
	var pos = {lat: a, lng: b };
	var map = new google.maps.Map(document.getElementById('map'), {
        center: pos,
        zoom: 14
    });
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
    });

	})(jQuery);