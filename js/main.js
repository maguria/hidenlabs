$(document).ready(function() {

	$(".contenedor").on("click",".botonMenu", mostrarmenu);
	$("#cuerpo").on('click','.copiaClave',copiaClave);
	$(".inputBuscarNombre").on('keyup',buscarWeb);
    $(".itemclientes").on("click",mostrarEmpresa);
    $("#btnCierraModal").on("click",cerrarModal);
	$(".tablaNombres").tablesorter({
		sortColumn: 'nombre',			
		sortClassAsc: 'headerSortUp',		
		sortClassDesc: 'headerSortDown',	
		headerClass: 'header'
	});
    $("#btnabre301").on("click",abre301);
    $("#cuerpo").on('click',".volver",volver);
});
function mostrarmenu(){
	$("#menu").toggleClass("animacion");
	$("#cuerpo").toggleClass("mayor");
	$("#cuerpo").toggleClass("menor");
	$("#flechaIzquierda").toggleClass("oculto");
	$("#flechaDerecha").toggleClass("oculto");
    $("header").toggleClass("oculto");
    $(".footer").toggleClass("oculto");
}
function copiaClave(){
	var input = $("#claveCuenta_"+$(this).attr("data-id"));
	input.attr("type","text");
	input.select();
	document.execCommand("copy");
	input.attr("type","password");
}
function abre301(){
    window.open("../301/r301.php",'_blank');
}

function buscarWeb(){
	var rex = new RegExp($(this).val(), 'i');
    $('.cuerpoTabla tr').hide();
    $('.cuerpoTabla tr').filter(function () {
    return rex.test($(this).text());
    }).show();
}

function volver(){
    window.location.href="../menus/principal.php";
}
function mostrarEmpresa(){
        $("#fondoModal").toggleClass("oculto");
		$("#vmodal").toggleClass("oculto");
        $("#imagenEmpresa").html("<img src='../img/clientes/"+$(this).attr("data-img")+".png' class='imgEmpresa'/>");
       $("#definicionEmpresa").html("<div id='defEmpresa'><p>"+$(this).attr("data-def")+"</p></div>");
}
function cerrarModal(){
    $("#fondoModal").toggleClass("oculto");
    $("#vmodal").toggleClass("oculto");
}