<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorCuentas=new GestorCuentas($bd);
$gestorTipos=new Gestor_tipos_de_cuentas($bd);
$gestorWebs=new GestorWebs($bd);
$idCuenta=Request::req("idCuenta");
$idWeb=$gestorCuentas->getWebCuenta($idCuenta);
$url=$gestorWebs->get($idWeb)->getUrl();
$cuenta=$gestorCuentas->getPorId($idCuenta);
$tipo=$gestorTipos->getPorCuenta($idCuenta);
$tipoJson=$tipo->getJson();
$cuentaJson=$cuenta->getJson();
echo '{"tabla":"cuentas","cuenta":'.$cuentaJson.',"tipo":'.$tipoJson.',"url":"'.$url.'"}';
$bd->close();