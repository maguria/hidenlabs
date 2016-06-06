<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorWebs=new GestorWebs($bd);
$idWeb=Request::req("idWeb");
$gestorPrincipal = new GestorPermisosPrincipal($bd);
$web=$gestorWebs->get($idWeb);
$webJson=$web->getJson();
echo '{"tabla":"webs","web":'.$webJson.'}';
$bd->close();