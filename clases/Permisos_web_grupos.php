<?php

class Permisos_web_grupos{
	private $id_web, $id_permiso,$id_grupo;

	function __construct($id_web=null,$id_permiso=null, $id_grupo=null){
	 	$this->id_web=$id_web;
	 	$this->id_permiso=$id_permiso;
	 	$this->id_grupo=$id_grupo;
	 }
	  function getId_web(){
	 	return $this->id_web;
	 }
	  function getId_permiso(){
	 	return $this->id_permiso;
	 }
	  function getId_grupo(){
	 	return $this->id_grupo;
	 }
	  function setId_web($id_web){
	 	$this->id_web=$id_web;
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
}