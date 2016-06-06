<?php
require '../clases/AutoCarga.php';
header('Content-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorWebs = new GestorWebs($bd);
$gestorPermisos=new GestorPermisosPrincipal($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$idWeb=Request::req("idWeb");
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$cuentasJson=$gestorPermisos->getListadoCuentasWebJson($idUsuario,$idWeb);
$web=$gestorWebs->get($idWeb);
echo '{"nombreWeb":"' .$web->getNombre(). '","urlWeb":"'.$web->getUrl().'","descripcionWeb":"'.$web->getDescripcion().'","imagenWeb":"'.$web->getImagen().'","cuentas":'.$cuentasJson.'}';
$bd->close();