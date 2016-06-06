<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorWebs=new GestorWebs($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosWebUsuarios=new Gestor_permisos_web_usuarios($bd);
$gestorPermisosWebGrupos=new Gestor_permisos_web_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$datos=Request::req("datosTabla");
$idWeb=Request::req("idWeb");
$datos=json_decode($datos);
$id=$datos->{"id"};
$nombre=$datos->{"nombre"};
$url=$datos->{"url"};
$descripcion=$datos->{"descripcion"};
$idTipo=$datos->{"id_tipo_web"};
$r="";

if(!Filter::isMinLength($nombre,128)){
	 $r="Nombre excede longitud";
}

elseif(!Filter::isUrl($url)){
	$r="Url no válida";
}

elseif($idTipo<0 || $idTipo>1){
	$r="Id_tipo_web debe ser 0 o 1º";
}

elseif($gestorPermisosWebUsuarios->tienePermisoEscritura($idWeb,$idUsuario)==0 && $gestorPermisosWebGrupos->tienePermisoEscrituraGrupo($idWeb,$idUsuario)==0){
	$r="No tiene permisos para editar esta web";
}
else{
	$web=new webs($id,$nombre,$url,$descripcion,$idTipo);
	$w=$gestorWebs->set($web);
	if($w!=-1){
		$r="Web editada";
	}
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();