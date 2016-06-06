<?php
class Relacion_web_cuentas{
	private $id_web, $id_cuenta;

	 function __construct($id_web=null, $id_cuenta=null){
	 	$this->id_web=$id_web;
	 	$this->id_cuenta=$id_cuenta;
	 	
	 }
	 function getId_web(){
	 	return $this->id_web;
	 }
	  function getId_cuenta(){
	 	return $this->id_cuenta;
	 }
	  function setId_web($id_web){
	 	$this->id_web=$id_web;
	 }
	 function setId_cuenta($id_cuenta){
	 	$this->id_cuenta=$id_cuenta;
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