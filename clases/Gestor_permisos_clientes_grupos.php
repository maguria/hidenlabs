<?php

class Gestor_permisos_clientes_grupos{
	private $bd = null;
    private $tabla = "permisos_clientes_grupos";
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function tienePermisoEscrituraGrupo($id_cliente,$id_usuario){
        $parametros=array();
        $parametros["id_cliente"]=$id_cliente;
        $parametros["id_usuario"]=$id_usuario;
        $sql='SELECT count(*) FROM permisos_clientes_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_cliente = :id_cliente and id_permiso=2';
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
}