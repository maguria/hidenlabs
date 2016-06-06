<?php

class Gestor_relacion_usuarios_grupos{
	private $bd = null;
    private $tabla = "relacion_usuarios_grupos";
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
     function insert(Relacion_usuarios_grupos $rel){
        return $this->bd->insert($this->tabla, $rel->getGenerico());
    }
    //Sacamos grupo al que pertenece el usuario que le pasamos como parámetro
    function getGrupoPorUsuario($id_usuario){
    	$parametros=array();
        $parametros["id_usuario"]=$id_usuario;
        $this->bd->select($this->tabla, "id_grupo_de_usuarios", "id_usuario = :id_usuario", $parametros,"id_grupo_de_usuarios");
        $r=array();
        while($row = $this->bd->getRow()){
            $rusugrupo= new Relacion_usuarios_grupos();
            $rusugrupo->set($row);
            $r[]=$rusugrupo;
        }
        return $r;
    }
    function esAdmin($idUsuario){
        $grupos=$this->getGrupoPorUsuario($idUsuario);
        $admin=false;
        foreach($grupos as $g){
            if($g->getId_grupo_de_usuarios()==2 || $g->getId_grupo_de_usuarios()==3){
             $admin=true;
             break;
            }
         }
         return $admin;
    
    }
}

