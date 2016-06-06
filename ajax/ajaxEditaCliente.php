<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorClientes=new GestorClientes($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosClientesUsuarios=new Gestor_permisos_clientes_usuarios($bd);
$gestorPermisosClientesGrupos=new Gestor_permisos_clientes_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$datos=Request::req("datosTabla");
$idCliente=Request::req("idCliente");
$datos=json_decode($datos);
$id=$datos->{"id"};
$nombre=$datos->{"nombre"};
$url=$datos->{"url"};
$descripcion=$datos->{"descripcion"};
$imagen=$datos->{"imagen"};
$r="";

if(!Filter::isMinLength($nombre,64)){
	 $r="Nombre excede longitud";
}
elseif(!Filter::isMinLength($descripcion,64)){
	$r="Descripción excede longitud";
}
elseif(!Filter::isUrl($url)){
	$r="Url no válida";
}

elseif($gestorPermisosClientesUsuarios->tienePermisoEscritura($idCliente,$idUsuario)==0 && $gestorPermisosClientesGrupos->tienePermisoEscrituraGrupo($idCliente,$idUsuario)==0){
	$r="No tiene permisos para editar este cliente";
}
else{
	$cliente=new Clientes($id,$nombre,$descripcion,$url,$imagen);
	$c=$gestorClientes->set($cliente);
	if($c!=-1){
		$r="Cliente editado";
	}
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();