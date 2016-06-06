<?php

class GestorPermisosPrincipal{
	private $bd = null,$permisos;

    function __construct(DataBase $bd) {
        $this->permisos="(1,2)";
        $this->bd = $bd;  
    }
   
    function tienePermisosMenuGrupo($id_menu,$id_usuario){
        $parametros=array();
        $parametros["id_menu"]=$id_menu;
        $parametros["id_usuario"]=$id_usuario;
    	$sql='SELECT count(*) FROM permisos_menu_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_menu = :id_menu and id_permiso in '.$this->permisos;
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
    function escribeMenu($id_tipo,$id_usuario){
        $gestorMenu=new GestorMenu($this->bd);
        $gestorPermisosMenuUsuario=new Gestor_permisos_menu_usuarios($this->bd);
    	$listado=$gestorMenu->getListadoMenu($id_tipo);
    	$resultado=array();
    	foreach($listado as $indice=>$m){
				if($gestorPermisosMenuUsuario->tienePermisos($m->getId(),$id_usuario)>0){
				   $resultado[]=$gestorMenu->get($m->getId());
				}
				else{
					if($this->tienePermisosMenuGrupo($m->getId(),$id_usuario)>0){
						$resultado[]=$gestorMenu->get($m->getId());
					}					
				}
       }
       return $resultado;
   }

   function tienePermisosWebGrupo($id_web,$id_usuario){
        $parametros=array();
        $parametros["id_web"]=$id_web;
        $parametros["id_usuario"]=$id_usuario;
    	$sql='SELECT count(*) FROM permisos_web_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_web = :id_web  and id_permiso in '.$this->permisos;
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
    function escribeWebs($id_usuario){
        $gestorWebs=new GestorWebs($this->bd);
        $gestorPermisosWebUsuario=new Gestor_permisos_web_usuarios($this->bd);
    	$listado=$gestorWebs->getListadoWebs();
    	$resultado=array();
        $cuerpo="<div class='listadoNombres'><div class='inputNombre'><input class='inputBuscarNombre' type='text' placeholder='Filtrar web...'/><input type='button' id='btnFormularioInsertarWeb' value='Insertar' class='btnInsertar'/></div>";
        $cuerpo.="<div class='table-responsive'><table class='tablaNombres table'><thead><tr><th><span>Id</span></th><th><span>Nombre</span></th><th><span>Url</span></th><th><span>Descripción</span></th><th><span>Id_tipo_web</span></th></tr></thead><tbody class='cuerpoTabla'>";
    	foreach($listado as $indice=>$w){
				if($gestorPermisosWebUsuario->tienePermisos($w->getId(),$id_usuario)>0){
				   $resultado[]=$gestorWebs->get($w->getId());
				}
				else{
					if($this->tienePermisosWebGrupo($w->getId(),$id_usuario)>0){
						$resultado[]=$gestorWebs->get($w->getId());
					}					
				}
       }
       foreach($resultado as $r){
            $cuerpo.= "<tr><td><h3><span>".$r->getId()."</span></h3></td><td><h3><span'>".$r->getNombre()."&nbsp;<a name='".$r->getId()."' class='enlaceWeb'><img src='../img/lupa.png'/></a></span><span><input type='button' class='btnEnlaceEditar enlaceEditaWeb' name='".$r->getId()."'/></span></h3></td><td><h4><span>".$r->getUrl()."</span></h4></td><td><span>".$r->getDescripcion()."</span></td><td><span>".$r->getId_tipo_web()."</span></td></tr>";
       }
       $cuerpo.="<tr><td class='boton301' colspan='5'><input type='button' id='btnabre301' value='Redirect 301' class='btnInsertar'></td></tr>";
       $cuerpo.="</tbody></table></div></div>";
       echo $cuerpo;
   }
   
   function tienePermisosAccionesGrupo($id_accion,$id_usuario){
        $parametros=array();
        $parametros["id_accion"]=$id_accion;
        $parametros["id_usuario"]=$id_usuario;
        $sql='SELECT count(*) FROM permisos_acciones_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_accion = :id_accion and id_permiso in '.$this->permisos;
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
    }
     function escribeAcciones($id_usuario,$id_cliente,$id_tipo_accion){
        $gestorAcciones=new GestorAcciones($this->bd);
        $gestorPermisosAccionesUsuario=new Gestor_permisos_acciones_usuarios($this->bd);
        $listado=$gestorAcciones->getListadoAcciones($id_cliente,$id_tipo_accion);
        $resultado=array();
        foreach($listado as $indice=>$a){
            if($gestorPermisosAccionesUsuario->tienePermisos($a->getId(),$id_usuario)>0){
                $resultado[]=$gestorAcciones->get($a->getId());
            }
            else{
                if($this->tienePermisosAccionesGrupo($a->getId(),$id_usuario)>0){
                    $resultado[]=$gestorAcciones->get($a->getId());
                }                   
            }
            }
       return $resultado;
   }
    function getListadoAccionesJson($id_usuario,$id_cliente,$id_tipo_accion) {
        $list = $this->escribeAcciones($id_usuario,$id_cliente,$id_tipo_accion);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
   function tienePermisosCuentasGrupo($id_cuenta,$id_usuario){
        $parametros=array();
        $parametros["id_cuenta"]=$id_cuenta;
        $parametros["id_usuario"]=$id_usuario;
        $sql='SELECT count(*) FROM permisos_cuentas_grupos where id_grupo in (SELECT id_grupo_de_usuarios from relacion_usuarios_grupos where id_usuario = :id_usuario) and id_cuenta = :id_cuenta and id_permiso in '.$this->permisos;
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];

    }

    function escribeCuentas($id_usuario,$id_web){
        $gestorCuentas=new GestorCuentas($this->bd);
        $gestorPermisosCuentasUsuario=new Gestor_permisos_cuentas_usuarios($this->bd);
        $resultado=array();
        $listado=$gestorCuentas->getListadoCuentasPorWeb($id_web);
        foreach($listado as $indice=>$c){
            if($gestorPermisosCuentasUsuario->tienePermisos($c->getId(),$id_usuario)>0){
                $resultado[]=$gestorCuentas->getConpermisoUsuario($c->getId());
            }
            else{
                if($this->tienePermisosCuentasGrupo($c->getId(),$id_usuario)>0){
                    $resultado[]=$gestorCuentas->getConPermisoGrupo($c->getId());
                }                   
            }
    }
    return $resultado;
   }
    function escribeTablaCuentas($id_usuario){
        $gestorCuentas=new GestorCuentas($this->bd);
        $gestorPermisosCuentasUsuario=new Gestor_permisos_cuentas_usuarios($this->bd);
          $listado=$gestorCuentas->getListadoCuentas();
        $resultado=array();
        $cuerpo="<div class='listadoNombres'><div class='inputNombre'><input class='inputBuscarNombre' type='text' placeholder='Filtrar cuenta...'/><input type='button' id='btnFormularioInsertarCuenta' value='Insertar' class='btnInsertar'/></div>";
        $cuerpo.="<div class='table-responsive'><table class='tablaNombres table'><thead><tr><th><span>Id</span></th><th><span>Usuario</span></th><th><span>Id_tipo_cuenta</span></th><th><span>url_acceso</span></th><th><span>Id_input_usuario</span></th><th><span>Id_input_password</span></th><th><span>Tipo</span></th><th><span>Web</span></th></tr></thead><tbody class='cuerpoTabla'>";
        foreach($listado as $indice=>$c){
                if($gestorPermisosCuentasUsuario->tienePermisos($c->getId(),$id_usuario)>0){
                     $resultado[]=$c;
                }
                else{
                    if($this->tienePermisosCuentasGrupo($c->getId(),$id_usuario)>0){
                       $resultado[]=$c;
                    }                   
                }
       }
       foreach($resultado as $r){
            $cuerpo.= "<tr><td><h3><span>".$r->getId()."</span></h3></td><td><h3>".$r->getUsuario(). "<input type='button' class='btnEnlaceEditar enlaceEditaCuenta' name='".$r->getId()."'/></span></h3></td><td><span>".$r->getIdTipoCuenta()."</span></td><td><span>".$r->getUrlAcceso()."</span></td><td><span>".$r->getIdInputUsuario()."</span></td><td><span>".$r->getIdInputPassword()."</span></td><td><span><img src='../img/".$r->getClase_css().".png' class='imagenTablaCuentas'/></span></td><td><span>".$r->getUrl()."</span></td></tr>";
       }
       $cuerpo.="</tbody></table></div></div>";
       echo $cuerpo;
   }

    function getListadoCuentasWebJson($idUsuario,$idWeb) {
        $list = $this->escribeCuentas($idUsuario,$idWeb);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJsonCuentasWeb() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
  
     //Método que nos devuelve una lista de usuarios
    function escribeTablaUsuarios(){
        $this->bd->select("usuarios", "*", "1=1", array(),"id");
        $r=array();
         $cuerpo="<div class='listadoNombres'><div class='inputNombre'><input class='inputBuscarNombre' type='text' placeholder=' usuario...'/><input type='button' id='btnFormularioInsertarUsuario' value='Insertar' class='btnInsertar'/></div>";
        $cuerpo.="<div class='table-responsive'><table class='tablaNombres table'><thead><tr><th><span>Id</span></th><th><span>Nombre</span></th><th><span>Apellidos</span></th><th><span>Email</span></th></tr></thead><tbody class='cuerpoTabla'>";
        while($row = $this->bd->getRow()){
            $usuario = new Usuarios();
            $usuario->set($row);
            $r[]=$usuario;
        }
        foreach($r as $res){
            $cuerpo.= "<tr><td><h3><span>".$res->getId()."</span></h3></td><td><h3><span>".$res->getNombre(). "<input type='button' class='btnEnlaceEditar enlaceEditaUsuario' name='".$res->getId()."'/></span></h3></td><td><h4><span>".$res->getApellidos()."</span></h4></td><td><span>".$res->getEmail()."</span></td></tr>";
        }
        $cuerpo.="</tbody></table></div></div>";
        echo $cuerpo;
    }
      //Método que nos devuelve una lista de clientes
    function escribeClientes(){
        $this->bd->select("clientes", "*", "1=1", array(),"id");
        $r=array();
        $cuerpo="<div class='listadoNombres'><div class='inputNombre'><input class='inputBuscarNombre' type='text' placeholder='Filtrar cliente...'/><input type='button' id='btnFormularioInsertarCliente' value='Insertar' class='btnInsertar'/></div>";
        $cuerpo.="<div class='table-responsive'><table class='tablaNombres table'><thead><tr><th><span>Nombre</span></th><th><span>Descripción</span></th><th><span>Url</span></th><th><span>Logo</span></th></tr></thead><tbody class='cuerpoTabla'>";
        while($row = $this->bd->getRow()){
            $cliente = new Clientes();
            $cliente->set($row);
            $r[]=$cliente;
        }
        foreach($r as $res){
            $cuerpo.= "<tr><td><h3>".$res->getNombre()."&nbsp;<a name='".$res->getId()."' class='enlaceCliente'><img src='../img/lupa.png'/></a><input type='button' class='btnEnlaceEditar enlaceEditaCliente' name='".$res->getId()."'/></h3></td><td><h4><span>".$res->getUrl()."</span></h4></td><td><span>".$res->getDescripcion()."</span></td><td><img class='imagenCliente' src='../".$res->getImagen()."'/></td></tr>";
        }
        $cuerpo.="</tbody></table></div></div>";
        echo $cuerpo;
    }
    
      function escribeTablaAcciones($id_usuario){
        $gestorAcciones=new GestorAcciones($this->bd);
        $gestorClientes=new GestorClientes($this->bd);
        $gestorTipos=new Gestor_tipo_accion($this->bd);
        $gestorPermisosAccionesUsuario=new Gestor_permisos_acciones_usuarios($this->bd);
        $listado=$gestorAcciones->getListadoAccionesGeneral();
        $resultado=array();
        $cuerpo="<div class='listadoNombres'><div class='inputNombre'><input class='inputBuscarNombre' type='text' placeholder='Filtrar tarea...'/><input type='button' id='btnFormularioInsertarAccion' value='Insertar' class='btnInsertar'/></div>";
        $cuerpo.="<div class='table-responsive'><table class='tablaNombres table'><thead><tr><th><span>Id</span></th><th><span>Nombre</span></th><th><span>Departamento</span></th><th><span>Cliente</span></th><th><span>Completado</span></th></tr></thead><tbody class='cuerpoTabla'>";
        foreach($listado as $indice=>$a){
                if($gestorPermisosAccionesUsuario->tienePermisos($a->getId(),$id_usuario)>0){
                     $resultado[]=$a;
                }
                else{
                    if($this->tienePermisosAccionesGrupo($a->getId(),$id_usuario)>0){
                       $resultado[]=$a;
                    }                   
                }
       }
       foreach($resultado as $r){
           $cliente=$gestorClientes->get($r->getId_cliente());
           $nombreCliente=$cliente->getNombre();
           $tipo=$gestorTipos->get($r->getId_tipo_accion());
           $nombreTipo=$tipo->getNombre();
            $cuerpo.= "<tr><td><h3><span>".$r->getId()."</span></h3></td><td><h3>".$r->getNombre(). "<input type='button' class='btnEnlaceEditar enlaceEditaAccion' name='".$r->getId()."'/></span></h3></td><td><span>".$nombreTipo."</span></td><td><span>".$nombreCliente."</span></td><td><span>".$r->getCompletado()."</span></td></tr>";
       }
       $cuerpo.="</tbody></table></div></div>";
       echo $cuerpo;
   }
    /*Obtener los ultimos ingresos de las tablas**************/
     function getUltimoIdInsertado($tabla){
        $parametros=array();
        $sql='SELECT MAX(id) AS id FROM '.$tabla;
        $this->bd->send($sql,$parametros);
        $fila=$this->bd->getRow();
        return $fila[0];
}
}
