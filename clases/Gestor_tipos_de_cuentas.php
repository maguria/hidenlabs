<?php
class Gestor_tipos_de_cuentas{
	private $bd = null;
    private $tabla = "tipos_de_cuentas";

    function __construct(DataBase $bd){
        $this->bd=$bd;
    }
 function getPorCuenta($idCuenta){
        $parametros = array();
        $parametros['id']=$idCuenta;
        $sql='select * from tipos_de_cuentas ti inner join cuentas cu on cu.id_tipo_cuenta=ti.id and cu.id='.$idCuenta;
        $this->bd->send($sql,$parametros);
        $row = $this->bd->getRow();
        $cuenta = new Tipos_de_cuentas();
        $cuenta->set($row);
        return $cuenta;
    }
}