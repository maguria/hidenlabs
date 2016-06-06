<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorCuentas=new GestorCuentas($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosCuentasUsuarios=new Gestor_permisos_cuentas_usuarios($bd);
$gestorPermisosCuentasGrupos=new Gestor_permisos_cuentas_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$datos=Request::req("datosTabla");
$idCuenta=Request::req("idCuenta");
$datos=json_decode($datos);
$id=$datos->{"id"};
$usuario=$datos->{"usuario"};
$password=$datos->{"password"};
$id_tipo_cuenta=$datos->{"id_tipo_cuenta"};
$url_acceso=$datos->{"url_acceso"};
$id_input_usuario=$datos->{"id_input_usuario"};
$id_input_password=$datos->{"id_input_password"};
$r="";

if(!Filter::isMinLength($usuario,32)){
	 $r="Usuario excede longitud";
}

else if(!Filter::isMinLength($password,64)){
	$r="Password excede longitud";
}

elseif(!Filter::isNumber($id_tipo_cuenta)){
	$r="Id_tipo_cuenta debe ser nº entero";
}

elseif(!Filter::isUrl($url_acceso)){
	$r="Url no válida";
}

elseif(!Filter::isMinLength($id_input_usuario,32)){
	$r="Id_input_usuario excede longitud";
}

elseif(!Filter::isMinLength($id_input_password,32)){
	$r="Id_input_password excede longitud";
}

elseif($gestorPermisosCuentasUsuarios->tienePermisoEscritura($idCuenta,$idUsuario)==0 && $gestorPermisosCuentasGrupos->tienePermisoEscrituraGrupo($idCuenta,$idUsuario)==0){
	$r="No tiene permisos para editar esta cuenta";
}
else{
	$cuenta=new Cuentas($id,$usuario,$password,$id_tipo_cuenta,$url_acceso,$id_input_usuario,$id_input_password);
	$u=$gestorCuentas->set($cuenta);
	if($u!=-1){
		$r="Cuenta editada";
	}
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();