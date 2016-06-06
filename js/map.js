window.onload=obtenerSituacion;
/*global google*/

 var directionsService=new google.maps.DirectionsService();
 var Display;
 var mapa;
 var miPosicion;
 var destino=new google.maps.LatLng(37.1700671,-3.5978388);
 
function obtenerSituacion() {
	if (navigator.geolocation) { // Nos aseguramos de que el navegador soporta la API Geolocation
		navigator.geolocation.getCurrentPosition(visualizarSituacion, errorSituacion); //Llamamos al método getCurrentPosition y le pasamos una función manejadora
	} else {
		alert("No hay soporte de geolocalización");
	}
}
function visualizarSituacion(posicion){
    miPosicion=new google.maps.LatLng(posicion.coords.latitude,posicion.coords.longitude);
    inicializar();
}
 
 
 function inicializar(){
     var opcionesMapa = {
		zoom: 10,
		center: miPosicion,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var divMapa = document.getElementById("mapa");
	 mapa = new google.maps.Map(divMapa, opcionesMapa);
     Display=new google.maps.DirectionsRenderer();
     Display.setMap(mapa);
     Route();
}
function Route(){
        var request={
        origin:miPosicion,
        destination:destino,
        travelMode:google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(result,status){
        if(status==google.maps.DirectionsStatus.OK){
            Display.setDirections(result);
        }
    });
}
function errorSituacion(error) {
	var tiposError = {
		0: "Error desconocido",
		1: "Permiso denegado por el usuario",
		2: "Posicion no disponible",
		3: "Tiempo excedido"
	};
	var mensajeError = tiposError[error.code];
	if (error.code === 0 || error.code === 2) {
		mensajeError = mensajeError + " " + error.message;
	}
}
