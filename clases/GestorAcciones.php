<?php

class GestorAcciones{
	private $bd = null;
    private $tabla = "acciones";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Devuelve un objeto acciones cuyo id_cliente e id_tipo acción le pasamos como parámetro
      function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id");
        $row = $this->bd->getRow();
        $accion = new Acciones();
        $accion->set($row);
        return $accion;
    }
     //Método para actualizar
    function set(Acciones $accion){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$accion->getId();
        return $this->bd->update($this->tabla, $accion->getGenerico(), $parametrosWhere);
    }
     function getListadoAcciones($id_cliente,$id_tipo_accion){
        $parametros=array();
        $parametros["id_tipo_accion"]=$id_tipo_accion;
        $parametros["id_cliente"]=$id_cliente;
        $this->bd->select($this->tabla, "id", "id_cliente = :id_cliente and id_tipo_accion = :id_tipo_accion and completado=0", $parametros,"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $acciones= new Acciones();
            $acciones->set($row);
            $r[]=$acciones;
        }
        return $r;
    }
     function getListadoAccionesGeneral(){
        $parametros=array();
        $this->bd->select($this->tabla, "*", "1=1", $parametros,"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $acciones= new Acciones();
            $acciones->set($row);
            $r[]=$acciones;
        }
        return $r;
    }
    function insert(Acciones $accion){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $accion->getGenerico());
    }
}