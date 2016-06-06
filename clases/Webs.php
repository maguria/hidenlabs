<?php
class Webs{
	private $id,$nombre,$url,$descripcion,$id_tipo_web,$imagen;

	 function __construct($id=null, $nombre=null, $url=null, $descripcion=null,$id_tipo_web=null,$imagen=null){
	 	$this->id=$id;
	 	$this->nombre=$nombre;
	 	$this->url=$url;
	 	$this->descripcion=$descripcion;
	 	$this->id_tipo_web=$id_tipo_web;
        $this->imagen=$imagen;
	 }
	 function getId(){
	 	return $this->id;
	 }
	 function getNombre(){
	 	return $this->nombre;
	 }
	 function getUrl(){
	 	return $this->url;
	 }
	 function getDescripcion(){
	 	return $this->descripcion;
	 }
	 function getId_tipo_web(){
	 	return $this->id_tipo_web;
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
	 function setUrl($url){
	 	$this->url=$url;
	 }
	 function setDescripcion($descripcion){
	 	$this->descripcion=$descripcion;
	 }
	 function setId_tipo_web($id_tipo_web){
	 	$this->id_tipo_web=$id_tipo_web;
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