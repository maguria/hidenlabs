<?php

class Cuentas{
	private $id, $usuario, $password,$id_tipo_cuenta, $url_acceso, $id_input_usuario,$id_input_password;
	private $listado_de_campos=array("id","usuario","password","id_tipo_cuenta","url_acceso","id_input_usuario","id_input_password");
	//variables extendidas
	private $clase_css,$tipo_web,$id_permiso,$nombre,$url;

	function __construct($id=null,$usuario=null, $password=null,$id_tipo_cuenta=null,$url_acceso=null, $id_input_usuario=null,$id_input_password=null,$clase_css=null,$tipo_web=null,$id_permiso=null,$nombre=null,$url=null){
		$this->id=$id;
		$this->usuario=$usuario;
		$this->password=$password;
		$this->id_tipo_cuenta=$id_tipo_cuenta;
		$this->url_acceso=$url_acceso;
		$this->id_input_usuario=$id_input_usuario;
		$this->id_input_password=$id_input_password;
		$this->clase_css=$clase_css;
		$this->tipo_web=$tipo_web;
		$this->id_permiso=$id_permiso;
		$this->nombre=$nombre;
		$this->url=$url;

	}
	function getId(){
	 	return $this->id;
	}
	function getUsuario(){
		return $this->usuario;
	}
	function getPassword(){
		return $this->password;
	}
	function getIdTipoCuenta(){
		return $this->id_tipo_cuenta;
	}
	function getClase_css(){
		return $this->clase_css;
	}
	function getTipo_web(){
		return $this->tipo_web;
	}
	function getUrlAcceso(){
		return $this->url_acceso;
	}
	function getIdInputUsuario(){
		return $this->id_input_usuario;
	}
	function getIdInputPassword(){
		return $this->id_input_password;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getUrl(){
		return $this->url;
	}
    function getIdPermiso(){
    	return $id_permiso;
    }
	 function setId($id){
	 	$this->id=$id;
	}
	function setUsuario($usuario){
		$this->usuario=$usuario;
	}
	function setPassword($password){
		$this->password=$password;
	}
	function setId_tipo_cuenta($id_tipo_cuenta){
		$this->id_tipo_cuenta=$id_tipo_cuenta;
	}
	function setUrlAcceso($url_acceso){
		$this->url_acceso=$url_acceso;
	}
	function setIdInputUsuario($id_input_usuario){
		$this->id_input_usuario=$id_input_usuario;
	}
	function setIdInputPassword($id_input_password){
		$this->id_input_password=$id_input_password;
	}
	function setIdPermiso($id_permiso){
		$this->id_permiso_=$id_permiso;
	}
	function setNombre($nombre){
		$this->nombre=$nombre;
	}
	function setUrl($url){
		$this->url=$url;
	}
	function getGenerico(){
        $array = array();
        foreach ($this as $indice => $valor) {
        	if(in_array($indice,$this->listado_de_campos)){
            $array[$indice]=$valor;
        }
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
      function getJsonCuentasWeb(){
        $r = '{';
        foreach ($this as $indice => $valor) {
        	if($indice != "listado_de_campos"){
	            $r .= '"' . $indice . '":"' . $valor . '",';
	        }
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
       }

        function getJsonSinId(){
        $r = '{';
        foreach ($this as $indice => $valor) {
        	if($indice != "id" && in_array($indice, $this->listado_de_campos)){
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
        	if(in_array($indice, $this->listado_de_campos)){
            $r .= '"' . $indice . '":"' . $valor . '",';}
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

}