<?php

class Permisos_acciones_grupos{
	private $accion, $id_permiso,$id_grupo;

	function __construct($id_accion=null,$id_permiso=null, $id_grupo=null){
	 	$this->id_accion=$id_accion;
	 	$this->id_permiso=$id_permiso;
	 	$this->id_grupo=$id_grupo;
	 }
	  function getId_accion(){
	 	return $this->id_accion;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_grupo(){
	 	return $this->id_grupo;
	 }
	  function setId_accion($id_accion){
	 	$this->id_accion=$id_accion;
	 }
	  function setId_permiso($id_permiso){
	 	$this->id_permiso=$id_permiso;
	 }
	  function setId_grupo($id_grupo){
	 	$this->id_grupo=$id_grupo;
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