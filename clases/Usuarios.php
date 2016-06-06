<?php

class Usuarios{
	private $id, $nombre, $apellidos, $nombre_usuario, $password, $email, $direccion, $ciudad, $activo,$imagen;

	 function __construct($id=null, $nombre=null, $apellidos=null, $nombre_usuario=null,$password=null,$email=null,$direccion=null,$ciudad=null,$activo=1,$imagen=null){
	 	$this->id=$id;
	 	$this->nombre=$nombre;
	 	$this->apellidos=$apellidos;
	 	$this->nombre_usuario=$nombre_usuario;
	 	$this->password=$password;
	 	$this->email=$email;
	 	$this->direccion=$direccion;
	 	$this->ciudad=$ciudad;
	 	$this->activo=$activo;
        $this->imagen=$imagen;
	 }
	 function getId(){
	 	return $this->id;
	 }
	 function getNombre(){
	 	return $this->nombre;
	 }
	 function getApellidos(){
	 	return $this->apellidos;
	 }
	 function getNombre_usuario(){
	 	return $this->nombre_usuario;
	 }
	 function getPassword(){
	 	return $this->password;
	 }
	 function getEmail(){
	 	return $this->email;
	 }
	 function getDireccion(){
	 	return $this->direccion;
	 }
	 function getCiudad(){
	 	return $this->ciudad;
	 }
	 function getActivo(){
	 	return $this->activo;
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
	 function setApellidos($apellidos){
	 	$this->apellidos=$apellidos;
	 }
	 function setNombre_usuario($nombre_usuario){
	 	$this->nombre_usuario=$nombre_usuario;
	 }
	 function setPassword($password){
	 	$this->password=$password;
	 }
	 function setEmail($email){
	 	$this->email=$email;
	 }
	 function setDireccion($direccion){
	 	$this->direccion=$direccion;
	 }
	 function setCiudad($ciudad){
	 	$this->ciudad=$ciudad;
	 }
	 function setActivo($activo){
	 	$this->activo=$activo;
	 }
    function setImagen($imagen){
        $this->imagen=$imagen;
    }
	 public function __toString() {
        $r ="";
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r;
    }
    //Nos devuelve un array con los campos del usuario
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

     function read(){
        foreach ($this as $key=> $valor) {
            $this->$key= Request::req($key);
        }
    }

}