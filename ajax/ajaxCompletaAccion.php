<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorUsuarios=new GestorUsuarios($bd);
$gestorAcciones=new GestorAcciones($bd);
$gestorPermisosAccionesUsuarios=new Gestor_permisos_acciones_usuarios($bd);
$gestorPermisosAccionesGrupos=new Gestor_permisos_acciones_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$idAccion=Request::req("idAccion");
$idCliente=Request::req("idCliente");
$idTipo=Request::req("idTipo");
$accion=$gestorAcciones->get($idAccion);
$c="";
if($gestorPermisosAccionesUsuarios->tienePermisoEscritura($idAccion,$idUsuario)!=0 || $gestorPermisosAccionesGrupos->tienePermisoEscrituraGrupo($idAccion,$idUsuario)!=0){
	$accion->setCompletado(1);
	$gestorAcciones->set($accion);
	$c="Tarea completada";
}
else{
	$c="No tiene permisos para realizar esta acción";
}
echo '{"mensaje":"'.$c.'"}';
$bd->close();