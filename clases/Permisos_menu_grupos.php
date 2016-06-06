<?php

class Permisos_menu_grupos{
	private $id_menu, $id_permiso,$id_grupo;

	function __construct($id_menu=null,$id_permiso=null, $id_grupo=null){
	 	$this->id_menu=$id_menu;
	 	$this->id_permiso=$id_permiso;
	 	$this->id_grupo=$id_grupo;
	 }
	  function getId_menu(){
	 	return $this->id_menu;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_grupo(){
	 	return $this->id_grupo;
	 }
	  function setId_menu($id_menu){
	 	$this->id_menu=$id_menu;
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