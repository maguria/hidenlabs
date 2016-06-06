<?php

class Gestor_relacion_web_cuentas{
	private $bd = null;
    private $tabla = "relacion_web_cuentas";
	
	function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

     function insert(Relacion_web_cuentas $rel){
        return $this->bd->insert($this->tabla, $rel->getGenerico());
    }
}

