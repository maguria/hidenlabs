<?php
class Relacion_usuarios_grupos{
	private $id_usuario, $id_grupo_de_usuarios;

	 function __construct($id_usuario=null,$id_grupo_de_usuarios=null){
	 	$this->id_usuario=$id_usuario;
	 	$this->id_grupo_de_usuarios=$id_grupo_de_usuarios;
	 	
	 }
	 function getId_usuario(){
	 	return $this->id_usuario;
	 }
	  function getId_grupo_de_usuarios(){
	 	return $this->id_grupo_de_usuarios;
	 }
	  function setId_usuario($id_usuario){
	 	$this->id_usuario=$id_usuario;
	 }
	 function setId_grupo_de_usuarios($id_grupo_de_usuarios){
	 	$this->id_grupo_de_usuarios=$id_grupo_de_usuarios;
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