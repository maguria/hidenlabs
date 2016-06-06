<?php

class GestorClientes{
	private $bd = null;
    private $tabla = "clientes";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto cliente
    function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id");
        $row = $this->bd->getRow();
        $cliente = new Clientes();
        $cliente->set($row);
        return $cliente;
    }
   
    //Método para borrar cliente por id
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    //Método para actualizar nuevo cliente
    function set(Clientes $cliente){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$cliente->getId();
        return $this->bd->update($this->tabla, $cliente->getGenerico(), $parametrosWhere);
    }
    //Método para insertar un objeto cliente
    function insert(Clientes $cliente){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $cliente->getGenerico());
    }
  
}