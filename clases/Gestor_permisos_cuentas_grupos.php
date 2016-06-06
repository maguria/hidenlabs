<?php
class Gestor_permisos_cuentas_grupos{
	private $bd = null;
    private $tabla = "permisos_cuentas_grupos";
    private $permisos;
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

     function tienePermisoEscrituraGrupo($id_cuenta,$id_usuario){
        $parametros=array();
        $parametros["id_cuenta"]=$id_cuenta;
        $parametros["id_usuario"]=$id_usuario;
        $sql='SELECT count(*) FROM permisos_cuentas_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_cuenta = :id_cuenta and id_permiso=2';
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
}