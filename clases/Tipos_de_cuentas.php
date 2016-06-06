<?php
class Tipos_de_cuentas{
	private $id,$nombre,$descripcion,$clase_css,$tipo_web;

	 function __construct($id=null, $nombre=null, $descripcion=null,$clase_css=null,$tipo_web=null){
	 	$this->id=$id;
	 	$this->nombre=$nombre;
	 	$this->descripcion=$descripcion;
	 	$this->clase_css=$clase_css;
	 	$this->tipo_web=$tipo_web;
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
	 function getClase_css(){
	 	return $this->clase_css;
	 }
	 function getTipo_web(){
	 	return $this->tipo_web;
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
	 function setClase_css($clase_css){
	 	$this->clase_css=$clase_css;
	 }
	 function setTipo_web($tipo_web){
	 	$this->tipo_web=$tipo_web;
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
function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
}