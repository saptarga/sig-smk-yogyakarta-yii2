(function ($) {
	var chekAkreditasi =[] ;
	var checkJurusan = [];
	var position = [];
	var jurusan =[];
	var markers = [];
	//var map;
	//var label = [];
	var objJurusan = [];
	var html ="";
	var infowindow = [];
	var point;
	var alamat;

	var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '</div>';
    
	getData();
	
	/*var center = {lat: -7.7908977, lng: 110.3491023 };
	map = new google.maps.Map(document.getElementById('map'), {
	    center: center,
	    zoom: 13
	});

	var infowindow = new google.maps.InfoWindow({
          content: contentString
        });*/

     var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-7.7908977, 110.3491023),
          zoom: 12
        });
     var infoWindow = new google.maps.InfoWindow;




	$(".myCheckBoxAkreditasi").click(function () {
		$('#spinner').show();
		chekAkreditasi = [];
	        $(".myCheckBoxAkreditasi").each(function(){
	            if($(this).is(":checked")) {
	                chekAkreditasi.push($(this).val());
	            }
	        });
	    getData();
	})

	$("#jurusan-table").on("click", ".myCheckBoxJurusan", function(){
		$('#spinner').show();
		//setMapOnAll(null, markersAkreditasi);
		checkJurusan = [];
	        $(".myCheckBoxJurusan").each(function(){
	            if($(this).is(":checked")) {
	                checkJurusan.push($(this).val());
	                $(this).prop('checked');
	            }
	        });
	    getData();
	});

	/*function getData(){
		$.get("index.php?r=daftar-jurusan/list", function(data){
			objJurusan = JSON.parse(data);
		});
		$.get("index.php?r=map/listmap",$.param({ data1: chekAkreditasi, data2 : checkJurusan}), function(data){
		position = [];
		label = [];
		$('#spinner').hide();
		obj = JSON.parse(data);
			$.each(obj, function(index, element) {
				obj2 = element.map;
				label.push(element.akreditasi);
				$.each(obj2, function(index, element) {
					position.push({lat: parseFloat(element.latitude), lng: parseFloat(element.longtitude)})
				});
			});
			//drop(position,label);
			tampilData(obj);
		});
	}*/

	function getData(){
		$.get("index.php?r=daftar-jurusan/list", function(data){
			objJurusan = JSON.parse(data);
		});

		$.get("index.php?r=map/listmap",$.param({ data1: chekAkreditasi, data2 : checkJurusan}), function(data){
		setMapOnAll(null);
		markers = [];
		$('#spinner').hide();

		obj = JSON.parse(data);
			$.each(obj, function(index, element) {
				obj2 = element.map;
				var nama_sekolah = element.nama_sekolah;
				var label = element.akreditasi;
				$.each(obj2, function(index, element) {
					point = new google.maps.LatLng(
					                  parseFloat(element.latitude),
					                  parseFloat(element.longtitude));
					alamat = element.alamat;
				});

				var infowincontent = document.createElement('div');
				              var strong = document.createElement('strong');
				              strong.textContent = nama_sekolah
				              infowincontent.appendChild(strong);
				              infowincontent.appendChild(document.createElement('br'));

				              var text = document.createElement('text');
				              text.textContent = alamat
				              infowincontent.appendChild(text);

				var marker = new google.maps.Marker({
				                map: map,
				                position: point,
				                label : label
				              });
				markers.push(marker);
				marker.addListener('click', function() {
				                infoWindow.setContent(infowincontent);
				                infoWindow.open(map, marker);
				              });



			});
			tampilData(obj);
		});

	}

	function tampilData(obj){
		$("#detailMap").html("");
		$.each(obj, function(index, element) {
			jurusan = element.detailJurusan;
			html = "";
			html += '<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title">';
			html +=      ' <a data-toggle="collapse" data-parent="#accordion" href="#collapse-'+index+'">';
			html +=       element.nama_sekolah;
			html +=       '</a></h4></div>';
			html +=  ' <div id="collapse-'+index+'" class="panel-collapse collapse">';
			html +=    ' <div class="box-body"><div class="row"><div class="col-md-12">';
			html +=		'<table class="table table-bordered">';
			html +=		  '<tr>';
			html +=		    '<td style="font-weight: bold;">NPSN </td>';
			html +=		    '<td>'+element.npsn+'</td>';
			html +=		  '</tr>';
			html +=		  '<tr>';
			html +=		    '<td style="font-weight: bold;">Nama Sekolah </td>';
			html +=		    '<td>'+element.nama_sekolah+'</td>';
			html +=		  '</tr>';
			html +=		  '<tr>';
			html +=		    '<td style="font-weight: bold;">No Telephone </td>';
			html +=		    '<td>'+element.no_telpn+'</td>';
			html +=		  '</tr>';
			html +=		  '<tr>';
			html +=		    '<td style="font-weight: bold;">Akreditasi </td>';
			html +=		    '<td>'+element.akreditasi+'</td>';
			html +=		  '</tr></table>';
			html +=			'</div></div>';
			html +=			'<div class="row"><div class="col-md-6">';
			html +=		'<table class="table table-bordered">';
			html +=			 '<tr><th style="width: 10px">#</th><th>Jurusan</th><th>AKREDITASI</th></tr>';
			$.each(jurusan, function(i, e) {
			no = parseInt(i)+1;
			html += 	  '<tr>';
			html +=		    '<td>'+no+'</td>';
				$.each(objJurusan, function(index2, element2) {
									if(element2.kode_jurusan == e.kode_jurusan){
			html +=		   					 '<td>'+element2.jurusan+'</td>';
										return false;
									}
				});
			html +=		    '<td>'+e.akreditasi+'</td>';
			html +=		  '</tr>';
			});
			html +=		'</table></div></div></div></div></div>';
	    $("#detailMap").append(html);
	  	});
	}

	function setMapOnAll(map) {
	  for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	  }
	}

	/*function drop(pos, label) {
        setMapOnAll(null);
        for (var i = 0; i < pos.length; i++) {
          addMarkerWithTimeout(pos[i], i * 200,label[i]);
        }
    }

    function addMarkerWithTimeout(position, timeout,label) {
        window.setTimeout(function() {
          markers.push(new google.maps.Marker({
            position: position,
            map: map,
            label: label,
            animation: google.maps.Animation.DROP,
          }));
        }, timeout);
    }*/
})(jQuery);