<?php

class Clientes{
	private $id, $nombre, $descripcion,$url,$imagen;

	function __construct($id=null,$nombre=null,$descripcion=null,$url=null,$imagen=null){
		$this->id=$id;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
		$this->url=$url;
		$this->imagen=$imagen;
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
	function getUrl(){
		return $this->url;
	}
	function getImagen(){
		return $this->imagen;
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
	function setUrl($url){
		$this->url=$url;
	}
	function setImagen($imagen){
		$this->imagen=$imagen;
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
    function getJsonSinId(){
        $r = '{';
        foreach ($this as $indice => $valor) {
        	if($indice != "id"){
            $r .= '"' . $indice . '":"' . $valor . '",';
           }
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

}