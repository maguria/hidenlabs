<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorAcciones=new GestorAcciones($bd);
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosAccionesUsuarios=new Gestor_permisos_acciones_usuarios($bd);
$gestorGrupos=new GestorGrupos($bd);
$gestorRelacionUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$relacion=$gestorRelacionUsuariosGrupos->getGrupoPorUsuario($idUsuario);
$insercion="";
foreach($relacion as $rel){
     if($gestorGrupos->get($rel->getId_grupo_de_usuarios())->getInsercion()==1){
         $insercion=1;
         break;
     }
}
$datos=Request::req("datosTabla");
$datos=json_decode($datos);
$idCliente=$datos->{"id_cliente"};
$idTipo=$datos->{"id_tipo_accion"};
$nombre=$datos->{"nombre"};
$completado=$datos->{"completado"};
$r="";
if($completado<0 || $completado>1){
	$r="Campo no válido. Debe ser 0 o 1";
}
elseif($insercion==1){
	$accion=new Acciones("",$idCliente,$idTipo,$nombre,$completado);
	$a=$gestorAcciones->insert($accion);
	if($a!=-1){
		$r="Tarea insertada";
	}
     /*Damos permiso de escritura por defecto al usuario que lo ha insertado buscando el ultimo id insertado***/
    $idInsertado=$gestorPrincipal->getUltimoIdInsertado("acciones");
    $permiso=new Permisos_acciones_usuarios($idInsertado,2,$idUsuario);
    $n=$gestorPermisosAccionesUsuarios->insert($permiso);
}	
else{
    $r="No tiene permisos de inserción";
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();