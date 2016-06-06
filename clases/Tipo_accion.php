<?php

class Tipo_accion{
	private $id, $nombre, $descripcion,$clase_css;

	function __construct($id=null,$nombre=null,$descripcion=null,$clase_css=null){
		$this->id=$id;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
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