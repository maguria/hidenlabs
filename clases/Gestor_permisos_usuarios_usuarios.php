<?php
class Gestor_permisos_usuarios_usuarios{
	private $bd = null;
    private $tabla = "permisos_usuarios_usuarios";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

      function tienePermisoEscritura($id_usuario_logueado,$id_usuario_editar){
        $parametros=array();
        $parametros["id_usuario_logueado"]=$id_usuario_logueado;
        $parametros["id_usuario_editar"]=$id_usuario_editar;
        return($this->bd->count($this->tabla, "id_usuario_logueado = :id_usuario_logueado and id_usuario_editar = :id_usuario_editar and id_permiso=2",$parametros));
    }
     function insert(Permisos_usuarios_usuarios $permiso){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $permiso->getGenerico());
    }
}