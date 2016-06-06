<?php
class Menu{
	private $id,$nombre,$descripcion,$orden,$clase_css,$alias;

	 function __construct($id=null, $nombre=null, $descripcion=null,$orden=null,$clase_css=null,$alias=null,$id_tipo_menu=null,$id_menu_padre=null){
	 	$this->id=$id;
	 	$this->nombre=$nombre;
	 	$this->descripcion=$descripcion;
	 	$this->orden=$orden;
	 	$this->clase_css=$clase_css;
	 	$this->alias=$alias;
	 	$this->id_tipo_menu=$id_tipo_menu;
	 	$this->id_menu_padre=$id_menu_padre;

	 }
	 function getId(){
	 	return $this->id;
	 }
	 function getNombre(){
	 	return $this->nombre;
	 }
	 function getDescripcion(){
	 	return $this->descripcion;
	 }
	 function getOrden(){
	 	return $this->orden;
	 }
	 function getClase_css(){
	 	return $this->clase_css;
	 }
	 function getId_tipo_menu(){
	 	return $this->id_tipo_menu;
	 }
	 function getId_menu_padre(){
	 	return $this->id_menu_padre;
	 }
	 function getAlias(){
	 	return $this->alias;
	 }
	 function setId($id){
	 	$this->id=$id;
	 }
	 function setNombre($nombre){
	 	$this->nombre=$nombre;
	 }
	 function setDescripcion($descripcion){
	 	$this->descripcion=$descripcion;
	 }
	 function setOrden($orden){
	 	$this->orden=$orden;
	 }
	 function setClase_css($clase_css){
	 	$this->clase_css=$clase_css;
	 }
	 function setId_tipo_menu($id_tipo_menu){
	 	$this->id_tipo_menu=$id_tipo_menu;
	 }
	 function setId_menu_padre($id_menu_padre){
	 	$this->id_menu_padre=$id_menu_padre;
	 }
	 function setAlias($alias){
	 	$this->alias=$alias;
	 }
	  function getGenerico(){
        $array = array();
        foreach ($this as $indice => $valor) {
            $array[$indice]=$valor;
        }
        return $array;
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