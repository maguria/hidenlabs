<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorClientes=new GestorClientes($bd);
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPermisosClientesUsuarios=new Gestor_permisos_clientes_usuarios($bd);
$gestorGrupos=new GestorGrupos($bd);
$gestorRelacionUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$relacion=$gestorRelacionUsuariosGrupos->getGrupoPorUsuario($idUsuario);
$insercion="";
foreach($relacion as $rel){
    $grupo=$gestorGrupos->get($rel->getId_grupo_de_usuarios());
     if($gestorGrupos->get($rel->getId_grupo_de_usuarios())->getInsercion()==1){
         $insercion=1;
         break;
     }
}
$datos=Request::req("datosTabla");
$datos=json_decode($datos);
$nombre=$datos->{"nombre"};
$descripcion=$datos->{"descripcion"};
$url=$datos->{"url"};
$imagen=$datos->{"imagen"};
$r="";
if(!Filter::isMinLength($nombre,64)){
	$r="Nombre no válido";
}

else if(!Filter::isUrl($url)){
	$r="Url no válida";
}
elseif($insercion==1){
	$cliente=new Clientes("",$nombre,$descripcion,$url,$imagen);
	$c=$gestorClientes->insert($cliente);
	if($c!=-1){
		$r="Cliente insertado";
	}
     /*Damos permiso de escritura por defecto al usuario que lo ha insertado buscando el ultimo id insertado***/
    $idInsertado=$gestorPrincipal->getUltimoIdInsertado("clientes");
    $permiso=new Permisos_clientes_usuarios($idInsertado,2,$idUsuario);
    $gestorPermisosClientesUsuarios->insert($permiso);
}	
else{
    $r="No tiene permisos de inserción";
}
echo '{"mensaje":"'.$r.'"}';
$bd->close();