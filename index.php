<!DOCTYPE html>
<html>
	<head>
	<!-- Esta seccion contiene los imports necesarios para el diseño de la pagina---->
	<!-- Los CSS utilizados siguen los patrones de material design-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<meta name="theme-color" content="#2196F3">
		<title>Volver a Casa</title>
		<link rel="icon" href="img/taxi.png" type="image/png">

		<!-- CSS  -->
		<link href="min/plugin-min.css" type="text/css" rel="stylesheet">
		<link href="min/custom-min.css" type="text/css" rel="stylesheet" >
		
		<style type="text/css">
		  html, body { height: 100%; margin: 0; padding: 0; }
		  #map { height: 90%; width:90%;  float: right;}
		  
		  .group        {  width:25%;float: left;
		  position:relative; 
			}
		input         {
		  font-size:18px;
		  padding:10px 10px 10px 5px;
		  display:block;
		  width:300px;
		  border:none;
		}
		input:focus     { outline:none; }
		
		label          {
		  color:#999; 
		  font-size:18px;
		  font-weight:normal;
		  position:absolute;
		  pointer-events:none;
		  left:5px;
		  top:10px;
		  transition:0.2s ease all; 
		}

		/* active state */
		input:focus ~ label, input:valid ~ label     {
		  top:-20px;
		  font-size:14px;
		  color:#5264AE;
		}
		

		</style>
	</head>
	<body id="top" class="scrollspy">

	<!-- Pre Loader -->
	<div id="loader-wrapper">
		<div id="loader"></div>
	 
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	 
	</div>
	
	

	<!--Navigation-->
	 <div class="navbar-fixed">
		<nav id="nav_f" class="default_color" role="navigation">
			<div class="container">
				<div class="nav-wrapper">
				<a href="#" id="logo-container" class="brand-logo">Volver a Casa</a>
					<ul class="right hide-on-med-and-down">
						<li><a href="#map">Mapa</a></li>
						<li><a href="#taxi">Taxi</a></li>
					</ul>
					<ul id="nav-mobile" class="side-nav">
						<li><a href="#map">Mapa</a></li>
						<li><a href="#taxi">Taxi</a></li>
					</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
				</div>
			</div>
		</nav>
	</div>
	
	<div class="group" style="padding:10px 10px 10px 5px;">
		<button>Volver a Casa</button>
	</div>
	
	<!--Mapa-->
	<div id="map"></div>
	<script type="text/javascript">
	
	//El siguiente codigo muestra a traves de un marcador la posicion del usuario
	var lat, lon, map, myOptions;
		function initMap() {
		
		var geocoder = new google.maps.Geocoder();
		//Va a revisar si el navegador es compatible con geolocalizacion

		if(navigator.geolocation){

		navigator.geolocation.getCurrentPosition(
		//obitene la posicion
			function(position){
				lat = position.coords.latitude;
				lon = position.coords.longitude;

			//centra al mapa de acuerdo a la posicion del usuario
				myOptions = {
				   center: new google.maps.LatLng(lat, lon),
				   zoom: 16,
				   mapTypeId: google.maps.MapTypeId.ROADMAP
				   
				};
				//con el siguiente codigo se agrega un marcador al mapa con el texto posicion actual
				map = new google.maps.Map(document.getElementById("map"),
					myOptions);
					var pinColor = "FE7569";
					var marker = new google.maps.Marker(
					{
						map: map,
						position: new google.maps.LatLng(lat, lon)
					});
					var infowindow = new google.maps.InfoWindow({
						content: "Posicion Actual"
					  });
					  directionsDisplay = new google.maps.DirectionsRenderer(); 
					 marker.addListener('click', function() {
						infowindow.open(map, marker);
					  });
					google.maps.event.addListener(marker, 'click', function() {  })
					
					
					
			},//en caso de error
			function(error){
				alert('ouch');
			});
			}
			//en caso de que el navegador no soporte geolocalizacion
			else {
				alert("Su navegador no soporta geolocalizacion");
			}
		}
		
		
		</script>
		
		<script async defer
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUXj3wnmtwlnJmMXNIdIzMsjqfHdT32hs&callback=initMap">
		</script>
		<!--  Scripts-->
		<script src="min/plugin-min.js"></script>
		<script src="min/custom-min.js"></script>
		
		<!--Taxi-->
<div id="taxi">
    <div class="container">
        <h2 class="header text_b"> Taxis Disponibles </h2>
        <div class="row">
		
		<?php
		//Se conecta a la base de datos
		$database =mysql_connect('127.0.0.1:3306', 'root', 'mysql') or die('Could not connect: ' . mysql_error()); 
			mysql_select_db('ecuaruta') or die('Could not select database');
		 
			$query = "SELECT * FROM Taxi ";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//crea un arreglo donde guardara los datos en las columnas
			
			$num = mysql_num_rows($result);
			
			for($i=0;$i<$num;$i++){
				$row = mysql_fetch_row($result);
		?>
		
            <div class="col s12 m4">
                <div class="card card-avatar">
                    <div class="waves-effect waves-block waves-light">
                        <img class="activator" src="img/bus.png">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><?php echo $row[1];?> <br/>
                            <small>
								<em><a class="red-text text-darken-1"><?php echo $row[2];?><br/></a></em>
							</small>
							<small>
								<em><a class="red-text text-darken-1"><?php echo $row[3];?><br/></a></em>
							</small>
							<small>
								<em><a class="red-text text-darken-1"><?php echo $row[5];?><br/></a></em>
							</small>
						</span>
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
            <?php }
			?>
            
    </div>
</div>
		

    </body>
</html>