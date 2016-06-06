<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new Database();
$gestorUsuarios=new GestorUsuarios($bd);
$idCliente=Request::req("idCliente");
$idUsuario=$gestorUsuarios->get($sesion->get("nombre"))->getId();
$gestorPermisos=new GestorPermisosPrincipal($bd);
$gestorClientes = new GestorClientes($bd);
$gestorTipo=new Gestor_tipo_accion($bd);
$tiposJson=$gestorTipo->getTipoAccionesJson($idCliente);
$cliente=$gestorClientes->get($idCliente);
$clienteJson=$cliente->getJson();
echo '{"tabla":"clientes","cliente":' .$clienteJson. ',"tiposAcciones":'.$tiposJson.'}';
$bd->close();