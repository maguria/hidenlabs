<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$idUsuario=Request::req("idUsuario");
$bd = new Database();
$gestorUsuarios = new GestorUsuarios($bd);
$usuario=$gestorUsuarios->getPorId($idUsuario);
$usuarioJson=$usuario->getJson();
echo '{"tabla":"usuarios","usuario":'.$usuarioJson.'}';
$bd->close();