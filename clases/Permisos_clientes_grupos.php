<?php

class Permisos_clientes_grupos{
	private $id_cliente, $id_permiso,$id_grupo;

	function __construct($id_cliente=null,$id_permiso=null, $id_grupo=null){
	 	$this->id_cliente=$id_cliente;
	 	$this->id_permiso=$id_permiso;
	 	$this->id_grupo=$id_grupo;
	 }
	  function getId_cliente(){
	 	return $this->id_cliente;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_grupo(){
	 	return $this->id_grupo;
	 }
	  function setId_cliente($id_cliente){
	 	$this->id_cliente=$id_cliente;
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