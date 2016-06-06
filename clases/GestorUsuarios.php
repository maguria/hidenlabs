<?php

class GestorUsuarios{
	private $bd = null;
    private $tabla = "usuarios";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto usuario
    function getPorId($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id");
        $row = $this->bd->getRow();
        $usuario = new Usuarios();
        $usuario->set($row);
        return $usuario;
    }
    
    //Devuelve objeto usuario por nombre
    function get($nombre){
        $parametros = array();
        $parametros['nombre']=$nombre;
        $parametros['nombre_usuario']=$nombre;
        $this->bd->select($this->tabla, "*", "nombre = :nombre or nombre_usuario = :nombre_usuario",$parametros,"nombre");
        $row = $this->bd->getRow();
        $usuario = new Usuarios();
        $usuario->set($row);
        return $usuario;
    }
   
    //Método para borrar usuario por id
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    //Método para el login. Comprobamos nombre y password, si nos devuelve una fila es correcto
    function getLogin($nombre_usuario,$password){
        $parametros=array();
        $parametros["nombre_usuario"]=$nombre_usuario;
        $parametros["password"]=$password;
        $this->bd->select($this->tabla,"count(*)","nombre_usuario=:nombre_usuario and password=:password",$parametros,"nombre");
        $fila= $this->bd->getRow();
        return $fila[0];   
    }
    //Método para actualizar nuevo usuario
    function set(Usuarios $usuario){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$usuario->getId();
        return $this->bd->update($this->tabla, $usuario->getGenerico(), $parametrosWhere);
    }
    //Método para insertar un objeto usuario
    function insert(Usuarios $usuario){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $usuario->getGenerico());
    }
   
}