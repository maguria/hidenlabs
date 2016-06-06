<?php

class Permisos_usuarios_grupos{
	private $id_usuario_editar, $id_permiso,$grupo;

	function __construct($id_usuario_editar=null,$id_permiso=null, $grupo=null){
	 	$this->id_usuario_editar=$id_usuario_editar;
	 	$this->id_permiso=$id_permiso;
	 	$this->grupo=$grupo;
	 }
	  function getId_usuario_editar(){
	 	return $this->id_usuario_editar;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_grupo(){
	 	return $this->grupo;
	 }
	  function setId_usuario_editar($id_usuario_editar){
	 	$this->id_usuario_editar=$id_usuario_editar;
	 }
	  function setId_permiso($id_permiso){
	 	$this->id_permiso=$id_permiso;
	 }
	  function setId_grupo($grupo){
	 	$this->grupo=$grupo;
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