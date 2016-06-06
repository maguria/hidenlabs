<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorCuentas=new GestorCuentas($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorGrupos=new GestorGrupos($bd);
$gestorPermisosCuentasUsuarios=new Gestor_permisos_cuentas_usuarios($bd);
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$gestorRelacionUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
$gestorRelacionWebCuentas=new Gestor_relacion_web_cuentas($bd);
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
$usuario=$datos->{"usuario"};
$password=$datos->{"password"};
$id_tipo_cuenta=$datos->{"id_tipo_cuenta"};
$url_acceso=$datos->{"url_acceso"};
$id_input_usuario=$datos->{"id_input_usuario"};
$id_input_password=$datos->{"id_input_password"};
$id_web=$datos->{"selectWeb"};
$r="";
if(!Filter::isNumber($id_tipo_cuenta)){
	$r="Id_tipo_cuenta debe ser nº entero";
}

elseif(!Filter::isUrl($url_acceso)){
	$r="Url no válida";
}

elseif($insercion==1){
	$cuenta=new Cuentas("",$usuario,$password,$id_tipo_cuenta,$url_acceso,$id_input_usuario,$id_input_password);
	$u=$gestorCuentas->insert($cuenta);
	if($u!=-1){
		$r="Cuenta insertada";
	}
       /*Damos permiso de escritura por defecto al usuario que lo ha insertado buscando el ultimo id insertado***/
    $idInsertado=$gestorPrincipal->getUltimoIdInsertado("cuentas");
    $permiso=new Permisos_cuentas_usuarios($idInsertado,2,$idUsuario);
    $gestorPermisosCuentasUsuarios->insert($permiso);
    $relacion=new Relacion_web_cuentas($id_web,$idInsertado);
    $gestorRelacionWebCuentas->insert($relacion);
}
else{
    $r="No tiene permisos de inserción";
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();