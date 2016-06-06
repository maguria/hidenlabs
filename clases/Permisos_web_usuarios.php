<?php

class Permisos_web_usuarios{
	private $id_web, $id_permiso,$id_usuario;

	function __construct($id_web=null,$id_permiso=null, $id_usuario=null){
	 	$this->id_web=$id_web;
	 	$this->id_permiso=$id_permiso;
	 	$this->id_usuario=$id_usuario;
	 }
	  function getId_web(){
	 	return $this->id_web;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_usuario(){
	 	return $this->id_usuario;
	 }
	  function setId_web($id_web){
	 	$this->id_menu=$id_menu;
	 }
	  function setId_permiso($id_permiso){
	 	$this->id_permiso=$id_permiso;
	 }
	  function setId_usuario($id_usuario){
	 	$this->id_usuario=$id_usuario;
	 }
	function set($valores, $inicio=0){
        $i=0;
        foreach ($this as $indice => $valor) {
        	if (isset($valores[$indice])){
        		$this->$indice=$valores[$indice];
        	}
        }
    }
    function getGenerico(){
        $array = array();
        foreach ($this as $indice => $valor) {
            $array[$indice]=$valor;
        }
        return $array;
    }
}