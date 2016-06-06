<?php

class GestorCuentas{
	private $bd = null;
    private $tabla = "cuentas";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
     function getPorId($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "id,usuario,password,id_tipo_cuenta,url_acceso,id_input_usuario,id_input_password", "id = :id",$parametros,"id");
        $row = $this->bd->getRow();
        $cuenta = new Cuentas();
        $cuenta->set($row);
        return $cuenta;
    }
    
    function getConPermisoGrupo($id){
        $parametros = array();
        $parametros['id']=$id;
        $sql='select cu.id,cu.usuario,cu.password,cu.url_acceso,cu.id_input_usuario,cu.id_input_password,ti.clase_css,ti.tipo_web,pcg.id_permiso from cuentas cu inner join tipos_de_cuentas ti on cu.id_tipo_cuenta=ti.id inner join permisos_cuentas_grupos pcg on cu.id=pcg.id_cuenta and cu.id='.$id;
        $this->bd->send($sql,$parametros);
        $row = $this->bd->getRow();
        $cuenta = new Cuentas();
        $cuenta->set($row);
        return $cuenta;
    }
      function getConPermisoUsuario($id){
        $parametros = array();
        $parametros['id']=$id;
        $sql='select cu.id,cu.usuario,cu.password,cu.url_acceso,cu.id_input_usuario,cu.id_input_password,ti.clase_css,ti.tipo_web,pcu.id_permiso from cuentas cu inner join tipos_de_cuentas ti on cu.id_tipo_cuenta=ti.id inner join permisos_cuentas_usuarios pcu on cu.id=pcu.id_cuenta and cu.id='.$id;
        $this->bd->send($sql,$parametros);
        $row = $this->bd->getRow();
        $cuenta = new Cuentas();
        $cuenta->set($row);
        return $cuenta;
    }
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    function set(Cuentas $cuenta){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$cuenta->getId();
        return $this->bd->update($this->tabla, $cuenta->getGenerico(), $parametrosWhere);
    }
  
    function insert(Cuentas $cuenta){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $cuenta->getGenerico());
    }
     //Método para contar registros
     function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    function getListadoCuentas(){
        $parametros=array();
        $sql="select cuentas.*,tipos_de_cuentas.nombre,tipos_de_cuentas.clase_css,webs.url from cuentas inner join tipos_de_cuentas on cuentas.id_tipo_cuenta=tipos_de_cuentas.id inner join relacion_web_cuentas on cuentas.id=relacion_web_cuentas.id_cuenta inner join webs on webs.id=relacion_web_cuentas.id_web group by cuentas.id";
        $this->bd->send($sql,$parametros);
         while($fila=$this->bd->getRow()){
            $cuentas= new Cuentas();
            $cuentas->set($fila);
            $r[]=$cuentas;
         }
        //print_r($r);
        return $r;
    }
    function getListadoCuentasPorWeb($idWeb){
        $parametros=array();
        $r=array();
        $sql='select cu.id from cuentas cu inner join relacion_web_cuentas on cu.id=relacion_web_cuentas.id_cuenta and relacion_web_cuentas.id_web='.$idWeb.' inner join tipos_de_cuentas ti on cu.id_tipo_cuenta=ti.id';
        $this->bd->send($sql,$parametros);
        while($fila=$this->bd->getRow()){
            $cuentas= new Cuentas();
            $cuentas->set($fila);
            $r[]=$cuentas;
         }
        return $r;
   }
    function getWebCuenta($idCuenta){
        $parametros=array();
        $parametros["id_cuenta"]=$idCuenta;
        $sql='select id_web from relacion_web_cuentas where id_cuenta='.$idCuenta;
        $this->bd->send($sql,$parametros);
         $fila=$this->bd->getRow();
        return $fila[0];
   }

   
}