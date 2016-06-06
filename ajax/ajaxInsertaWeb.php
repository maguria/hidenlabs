<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorWebs=new GestorWebs($bd);
$gestorPermisosWebUsuarios=new Gestor_permisos_web_usuarios($bd);
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$gestorGrupos=new GestorGrupos($bd);
$gestorRelacionUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
$relacion=$gestorRelacionUsuariosGrupos->getGrupoPorUsuario($idUsuario);
foreach($relacion as $rel){
     if($gestorGrupos->get($rel->getId_grupo_de_usuarios())->getInsercion()==1){
         $insercion=1;
         break;
     }
}
$datos=Request::req("datosTabla");
$datos=json_decode($datos);
$nombre=$datos->{"nombre"};
$url=$datos->{"url"};
$descripcion=$datos->{"descripcion"};
$idTipoWeb=$datos->{"id_tipo_web"};
$imagen=$datos->{"imagen"};
$r="";
$insercion="";
if(!Filter::isNumber($idTipoWeb)){
	$r="id_tipo_web debe ser un número entero";
}
elseif($insercion==1){
	$web=new Webs("",$nombre,$url,$descripcion,$idTipoWeb,$imagen);
	$w=$gestorWebs->insert($web);
    if($w!=-1){
		$r="Web insertada";
	}
    /*Damos permiso de escritura por defecto al usuario que lo ha insertado buscando el ultimo id insertado***/
    $idInsertado=$gestorPrincipal->getUltimoIdInsertado("webs");
    $permiso=new Permisos_web_usuarios($idInsertado,2,$idUsuario);
    $gestorPermisosWebUsuarios->insert($permiso);	
}
else{
    $r="No tiene permisos de inserción";
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();