<?php

class Gestor_permisos_menu_grupos{
	private $bd = null;
    private $tabla = "permisos_menu_grupos";
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    //Sacamos id_menu pasándole el id_grupo con permiso
     function getMenuPermisosGrupo($id_grupo){
    	$parametros=array();
        $parametros["id_grupo"]=$id_grupo;
        $this->bd->select($this->tabla, "*", "id_grupo = :id_grupo and id_permiso=1", $parametros,"id_grupo");
        $r=array();
        while($row = $this->bd->getRow()){
            $pmenugrupo= new permisos_menu_grupos();
            $pmenugrupo->set($row);
            $r[]=$pmenugrupo;
        }
        return $r;
    }

    //Sacamos id_pasándole id_menu como parametro
    function getGrupoPorMenu($id_menu){
        $parametros=array();
        $parametros["id_menu"]=$id_menu;
        $this->bd->select($this->tabla,"*","id_menu = :id_menu",$parametros,"id_menu");
        $r=array();
          while($row = $this->bd->getRow()){
            $grupoMenu= new permisos_menu_grupos();
            $grupoMenu->set($row);
            $r[]=$grupoMenu;
        }
        return $r;

    }

}