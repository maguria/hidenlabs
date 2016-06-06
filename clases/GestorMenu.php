<?php

class GestorMenu{
	private $bd = null;
    private $tabla = "menu";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    //Método que nos devuelve un objeto menu
    function get($id){
        $parametros = array();
        $parametros['id']=$id;
        $this->bd->select($this->tabla, "*", "id = :id",$parametros,"id" );
        $row = $this->bd->getRow();
        $menu = new Menu();
        $menu->set($row);
        return $menu;
    }
     //Método para borrar menu por id
      function delete($id){
        $parametros=array();
        $parametros["id"]=$id;
        return $this->bd->delete($this->tabla, $parametros);
    }
   
    //Método para actualizar nuevo menu
    function set(Menu $menu){
        $parametrosWhere=array();
        $parametrosWhere["id"]=$menu->getId();
        return $this->bd->update($this->tabla, $menu->getGenerico(), $parametrosWhere);
    }
    //Método para insertar un objeto menu
    function insert(Menu $menu){
        //inserta un objeto y devuelve el ID
        return $this->bd->insert($this->tabla, $menu->getGenerico());
    }
    //Método que nos devuelve una lista de menus por id_menu_tipo
    function getListadoMenu($id_tipo_menu){
        $parametros=array();
        $parametros["id_tipo_menu"]=$id_tipo_menu;
        $this->bd->select($this->tabla, "*", "id_tipo_menu = :id_tipo_menu", $parametros,"id");
        $r=array();
        while($row = $this->bd->getRow()){
            $menu= new Menu();
            $menu->set($row);
            $r[]=$menu;
        }
        return $r;
    }
  	
    /*function getDisenioMenu($listado_menus){
    	$html="<div class='menu ".$menu->getClaseCSS();."'>";
    	foreach($listado_menus as $menu){
    		$html.=$menu->getHTMLelementomenu();
    	}
    	$html.="</div>";
    }*/

}

