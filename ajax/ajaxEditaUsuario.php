<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosUsuariosUsuarios=new Gestor_permisos_usuarios_usuarios($bd);
$gestorPermisosUsuariosGrupos=new Gestor_permisos_usuarios_grupos($bd);
$datos=Request::req("datosTabla");
$datos=json_decode($datos);
$idLogueado=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$idEditar=Request::req("idUsuario");
$nombre=$datos->{"nombre"};
$apellidos=$datos->{"apellidos"};
$nombre_usuario=$datos->{"nombre_usuario"};
$password=$datos->{"password"};
$email=$datos->{"email"};
$direccion=$datos->{"direccion"};
$ciudad=$datos->{"ciudad"};
$activo=$datos->{"activo"};
$r="";

if(!Filter::isString($nombre,32)){
	$r="Nombre no válido";
}

else if(!Filter::isString($apellidos,64)){
	$r="Apellidos no válidos";
}

elseif(!Filter::isMinLength($nombre_usuario,16)){
	$r="Nombre_usuario excede longitud";
}

elseif(!Filter::isMinLength($password,32)){
	$r="Password excede longitud";
}

elseif(!Filter::isEmail($email) || !Filter::isMinLength($email,128)){
	$r="Email no válido";
}

elseif(!Filter::isMinLength($direccion,128)){
	$r="Dirección excede longitud";
}

elseif(!Filter::isString($ciudad,128)){
	$r="Ciudad no válida";
}

elseif($activo<0 || $activo>1){
	$r="Activo debe ser 0 ó 1";
}
elseif($gestorPermisosUsuariosUsuarios->tienePermisoEscritura($idLogueado,$idEditar)==0 && $gestorPermisosUsuariosGrupos->tienePermisoEscrituraGrupo($idLogueado,$idEditar)==0){
	$r="No tiene permisos para editar este usuario";
}
else{
	$usuario=new Usuarios($idEditar,$nombre,$apellidos,$nombre_usuario,$password,$email,$direccion,$ciudad,$activo);
	$u=$gestorUsuarios->set($usuario);
	if($u!=-1){
		$r="Usuario editado";
	}
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();