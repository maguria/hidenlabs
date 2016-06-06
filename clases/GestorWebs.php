<?php

class GestorWebs{
	private $bd = null;
    private $tabla = "webs";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto web
    function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id" );
        $row = $this->bd->getRow();
        $menu = new Webs();
        $menu->set($row);
        return $menu;
    }
     //Método para borrar web por id
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    //Método para actualizar nueva web
    function set(Webs $web){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$web->getId();
        return $this->bd->update($this->tabla, $web->getGenerico(), $parametrosWhere);
    }
    //Método para insertar un objeto web
    function insert(Webs $web){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $web->getGenerico());
    }
      function getListadoWebs(){
        $this->bd->select($this->tabla, "*", "1=1", array(),"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $web = new Webs();
            $web->set($row);
            $r[]=$web;
        }
        return $r;
    }
      function getListadoWebsJson() {
        $list = $this->getListadoWebs();
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

}

