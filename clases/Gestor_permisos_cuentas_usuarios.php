<?php

class Gestor_permisos_cuentas_usuarios{
	private $bd = null;
    private $tabla = "permisos_cuentas_usuarios";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
        $this->permisos="(1,2)";
    }

function tienePermisos($id_cuenta, $id_usuario){
        $parametros=array();
        $parametros["id_cuenta"]=$id_cuenta;
        $parametros["id_usuario"]=$id_usuario;
        return($this->bd->count($this->tabla, "id_cuenta = :id_cuenta and id_usuario = :id_usuario and id_permiso in ".$this->permisos, $parametros));
    }
    function tienePermisoEscritura($id_cuenta, $id_usuario){
        $parametros=array();
        $parametros["id_cuenta"]=$id_cuenta;
        $parametros["id_usuario"]=$id_usuario;
        return($this->bd->count($this->tabla, "id_cuenta = :id_cuenta and id_usuario = :id_usuario and id_permiso=2",$parametros));
    }
    
    function insert(Permisos_cuentas_usuarios $permiso){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $permiso->getGenerico());
    }
}