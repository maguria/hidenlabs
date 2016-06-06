<?php

class Gestor_permisos_clientes_usuarios{
	private $bd = null;
    private $tabla = "permisos_clientes_usuarios";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
        $this->permisos="(1,2)";
    }

function tienePermisos($id_cliente, $id_usuario){
        $parametros=array();
        $parametros["id_cliente"]=$id_cliente;
        $parametros["id_usuario"]=$id_usuario;
        return($this->bd->count($this->tabla, "id_cliente = :id_cliente and id_usuario = :id_usuario and id_permiso in ".$this->permisos, $parametros));
    }
    function tienePermisoEscritura($id_cliente, $id_usuario){
        $parametros=array();
        $parametros["id_cliente"]=$id_cliente;
        $parametros["id_usuario"]=$id_usuario;
        return($this->bd->count($this->tabla, "id_cliente = :id_cliente and id_usuario = :id_usuario and id_permiso=2",$parametros));
    }
     function insert(Permisos_clientes_usuarios $permiso){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $permiso->getGenerico());
    }
}