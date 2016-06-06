<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosUsuariosUsuarios=new Gestor_permisos_usuarios_usuarios($bd);
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$gestorGrupos=new GestorGrupos($bd);
$gestorRelacionUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
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
$nombre=$datos->{"nombre"};
$apellidos=$datos->{"apellidos"};
$nombre_usuario=$datos->{"nombre_usuario"};
$password=$datos->{"password"};
$email=$datos->{"email"};
$direccion=$datos->{"direccion"};
$ciudad=$datos->{"ciudad"};
$activo=$datos->{"activo"};
$imagen=$datos->{"imagen"};
$gruposSelect=$datos->{"selectGrupo"};
$r="";
if(!Filter::isString($nombre,32)){
	$r="Nombre no válido";
}

else if(!Filter::isString($apellidos,64)){
	$r="Apellidos no válidos";
}

elseif(!Filter::isEmail($email)){
	$r="Email no válido";
}

elseif($activo<0 || $activo>1){
	$r="Activo debe ser 0 ó 1";
}
elseif($insercion==1){
	$usuario=new Usuarios("",$nombre,$apellidos,$nombre_usuario,$password,$email,$direccion,$ciudad,$activo,$imagen);
	$u=$gestorUsuarios->insert($usuario);
	if($u!=-1){
		$r="Usuario insertado";
	}
    /*Damos permiso de escritura por defecto al usuario que lo ha insertado buscando el ultimo id insertado***/
    $idInsertado=$gestorPrincipal->getUltimoIdInsertado("usuarios");
    $permiso=new Permisos_usuarios_usuarios($idInsertado,2,$idUsuario);
    $gestorPermisosUsuariosUsuarios->insert($permiso);
    foreach($gruposSelect as $valor){
    $relacion=new Relacion_usuarios_grupos($idInsertado,$valor);
    $gestorRelacionUsuariosGrupos->insert($relacion);
}
}
else{
    $r="No tiene permisos de inserción";
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();