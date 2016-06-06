<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorClientes=new GestorClientes($bd);
$idCliente=Request::req("idCliente");
$gestorPrincipal = new GestorPermisosPrincipal($bd);
$cliente=$gestorClientes->get($idCliente);
$clienteJson=$cliente->getJson();
echo '{"tabla":"clientes","cliente":'.$clienteJson.'}';
$bd->close();