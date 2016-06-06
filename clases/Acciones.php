<?php

class Acciones{
	private $id,$id_cliente,$id_tipo_accion, $nombre,$completado;
	function __construct($id=null,$id_cliente=null,$id_tipo_accion=null,$nombre=null,$completado=null){
		$this->id=$id;
		$this->id_cliente=$id_cliente;
		$this->id_tipo_accion=$id_tipo_accion;
		$this->nombre=$nombre;
        $this->completado=$completado;
	}
	function getId(){
	 	return $this->id;
	}
	function getId_cliente(){
	 	return $this->id_cliente;
	}
	function getId_tipo_accion(){
	 	return $this->id_tipo_accion;
	}
	function getNombre(){
		return $this->nombre;
	}
    function getCompletado(){
        return $this->completado;
    }
    function setId($id){
	 	$this->id=$id;
	}
	function setId_cliente($id_cliente){
	 	$this->id_cliente=$id_cliente;
	}
	function setId_tipo_accion($id_tipo_accion){
	 	$this->id_tipo_accion=$id_tipo_accion;
	}
	function setNombre($nombre){
		$this->nombre=$nombre;
	}
    function setCompletado($completado){
        $this->completado=$completado;
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