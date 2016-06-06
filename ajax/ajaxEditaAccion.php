<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorAcciones=new GestorAcciones($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosAccionesUsuarios=new Gestor_permisos_acciones_usuarios($bd);
$gestorPermisosAccionesGrupos=new Gestor_permisos_acciones_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$datos=Request::req("datosTabla");
$datos=json_decode($datos);
$idAccion=$datos->{"id"};
$idCliente=$datos->{"id_cliente"};
$idTipo=$datos->{"id_tipo_accion"};
$nombre=$datos->{"nombre"};
$completado=$datos->{"completado"};
$r="";
if($completado<0 || $completado>1){
	$r="Campo no válido. Debe ser 0 o 1";
}
elseif($gestorPermisosAccionesUsuarios->tienePermisoEscritura($idAccion,$idUsuario)==0 && $gestorPermisosAccionesGrupos->tienePermisoEscrituraGrupo($idAccion,$idUsuario)==0){
	$r="No tiene permisos para editar esta tarea";
}
else{
	$accion=new Acciones($idAccion,$idCliente,$idTipo,$nombre,$completado);
	$a=$gestorAcciones->set($accion);
	if($a!=-1){
		$r="Tarea editada";
	}
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();