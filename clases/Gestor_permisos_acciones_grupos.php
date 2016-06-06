<?php

class Gestor_permisos_acciones_grupos{
	private $bd = null;
    private $tabla = "permisos_acciones_grupos";
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function tienePermisoEscrituraGrupo($id_accion,$id_usuario){
        $parametros=array();
        $parametros["id_accion"]=$id_accion;
        $parametros["id_usuario"]=$id_usuario;
        $sql='SELECT count(*) FROM permisos_acciones_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_accion = :id_accion and id_permiso=2';
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
}