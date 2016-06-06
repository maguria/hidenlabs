<?php

class GestorGrupos{
	private $bd = null;
    private $tabla = "grupos_de_usuarios";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto grupo
    function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id");
        $row = $this->bd->getRow();
        $grupo = new Grupos_de_usuarios();
        $grupo->set($row);
        return $grupo;
    }
   
    //Método para borrar grupo por id
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    //Método para actualizar nuevo grupo
    function set(Grupos_de_usuarios $grupo){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$grupo->getId();
        return $this->bd->update($this->tabla, $grupo->getGenerico(), $parametrosWhere);
    }
    //Método para insertar un objeto grupo
    function insert(Grupos_de_usuarios $grupo){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $grupo->getGenerico());
    }
    //Método que nos devuelve una lista de grupos
    function getListadoGrupos(){
        
        $this->bd->select($this->tabla, "*", "1=1", array(),"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $grupo = new Grupos_de_usuarios();
            $grupo->set($row);
            $r[]=$grupo;
        }
        return $r;
    }
    function getListadoGruposJson() {
        $list = $this->getListadoGrupos();
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    //Método para contar registros
     function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

	}