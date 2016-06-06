<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorAcciones=new GestorAcciones($bd);
$idAccion=Request::req("idAccion");
$gestorPrincipal = new GestorPermisosPrincipal($bd);
$accion=$gestorAcciones->get($idAccion);
$accionJson=$accion->getJson();
echo '{"tabla":"acciones","accion":'.$accionJson.'}';
$bd->close();