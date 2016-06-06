<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorUsuarios=new GestorUsuarios($bd);
$gestorPrincipal = new GestorPermisosPrincipal($bd);
$idTipo=Request::req("idTipo");
$idCliente=Request::req("idCliente");
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$acciones=$gestorPrincipal->getListadoAccionesJson($idUsuario,$idCliente,$idTipo);
echo '{"acciones":'.$acciones.'}';
$bd->close();