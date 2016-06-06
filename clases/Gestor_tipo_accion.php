<?php

class Gestor_tipo_accion{
	private $bd = null;
    private $tabla = "tipo_accion";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto cliente por parámetro
      function getPorNombre($nombre){
        $parametros = array();
        $parametros['nombre']=$nombre;
        $this->bd->select($this->tabla, "*", "nombre = :nombre",$parametros,"nombre" );
        $row = $this->bd->getRow();
        $tipo = new Tipo_accion();
        $tipo->set($row);
        return $tipo;
    }
    //Método que nos devuelve un objeto cliente por parámetro
      function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id" );
        $row = $this->bd->getRow();
        $tipo = new Tipo_accion();
        $tipo->set($row);
        return $tipo;
    }
   
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    function set(Tipo_accion $tipo_accion){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$tipo_accion->getId();
        return $this->bd->update($this->tabla, $tipo_accion->getGenerico(), $parametrosWhere);
    }
    function insert(Tipo_accion $tipo_accion){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $tipo_accion->getGenerico());
    }
   
    //Método para contar registros
     function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    function getListadoTipoAcciones(){
        $parametros=array();
        $this->bd->select($this->tabla, "*", "1=1", $parametros,"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $tipo= new Tipo_accion;
            $tipo->set($row);
            $r[]=$tipo;
        }
        return $r;
    }
       function escribeTipoAcciones($idCliente){
        $parametros=array();
        $r=array();
        $sql='SELECT agrupacion.id ,agrupacion.nombre,agrupacion.descripcion,agrupacion.clase_css FROM clientes left outer join (SELECT tipo_accion.nombre,acciones.id_cliente,tipo_accion.id,tipo_accion.descripcion,tipo_accion.clase_css FROM acciones inner join tipo_accion on acciones.id_tipo_accion=tipo_accion.id) as agrupacion on agrupacion.id_cliente ='.$idCliente.' group by agrupacion.nombre';
        $this->bd->send($sql,$parametros);
        while($fila=$this->bd->getRow()){
            $tipoacciones= new Tipo_accion();
            $tipoacciones->set($fila);
            $r[]=$tipoacciones;
         }
        // print_r($r);
        return $r;
   }

     function getTipoAccionesJson($idCliente) {
        $list = $this->escribeTipoAcciones($idCliente);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

}