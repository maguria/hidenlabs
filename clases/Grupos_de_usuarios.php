<?php
class Grupos_de_usuarios{
	private $id,$nombre,$descripcion,$id_grupo_padre,$insercion;

	 function __construct($id=null, $nombre=null, $descripcion=null,$id_grupo_padre=null,$insercion=0){
	 	$this->id=$id;
	 	$this->nombre=$nombre;
	 	$this->descripcion=$descripcion;
	 	$this->id_grupo_padre=$id_grupo_padre;
        $this->insercion=$insercion;
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
	 function getId_grupo_padre(){
	 	return $this->id_grupo_padre;
	 }
     function getInsercion(){
         return $this->insercion;
    }
	 function setId($id){
	 	$this->id=$id;
	 }
    function setInsercion($insercion){
        $this->insercion=$insercion;
    }
	 function setNombre($nombre){
	 	$this->nombre=$nombre;
	 }
	 function setDescripcion($descripcion){
	 	$this->descripcion=$descripcion;
	 }
	 function setId_grupo_padre($nombre){
	 	$this->id_grupo_padre=$id_grupo_padre;
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
            $r .= '"' . $indice . '":"' . $valor . '",';}
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
}