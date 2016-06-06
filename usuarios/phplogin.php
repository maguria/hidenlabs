<?php
require "../clases/AutoCarga.php";
$session=new Session();
$bd=new Database();
$gestor=new GestorUsuarios($bd);
$nombre_usuario=Request::post("nombre");
$password=Request::post("password");
$usuario=$gestor->get($nombre_usuario);
$id=$usuario->getId();
$resultadoLogin=$gestor->getLogin($nombre_usuario,$password);
if($resultadoLogin==1){
	if(!$session->get("nombre")){
    $session->set("nombre",$usuario->getNombre());
    }
	header('Location:../menus/principal.php');
}
else{
	$resultadoLogin=-1;
	header('Location:../index.php?r='.$resultadoLogin);
}