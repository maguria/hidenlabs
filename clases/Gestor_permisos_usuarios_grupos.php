<?php
class Gestor_permisos_usuarios_grupos{
	private $bd = null;
    private $tabla = "permisos_usuarios_grupos";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

     function tienePermisoEscrituraGrupo($id_usuario_logueado,$id_usuario_editar){
        $parametros=array();
        $parametros["id_usuario_editar"]=$id_usuario_editar;
        $parametros["id_usuario_logueado"]=$id_usuario_logueado;
        $sql='SELECT count(*) FROM permisos_usuarios_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario_logueado) and id_usuario_editar = :id_usuario_editar and id_permiso=2';
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
}