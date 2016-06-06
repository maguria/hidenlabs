<?php

class Gestor_permisos_menu_usuarios{
	private $bd = null;
    private $tabla = "permisos_menu_usuarios";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
        $this->permisos="(1,2,3)";
    }

function tienePermisos($id_menu, $id_usuario){
        $parametros=array();
        $parametros["id_menu"]=$id_menu;
        $parametros["id_usuario"]=$id_usuario;
        return($this->bd->count($this->tabla, "id_menu = :id_menu and id_usuario = :id_usuario and id_permiso in ".$this->permisos, $parametros));
    }
}