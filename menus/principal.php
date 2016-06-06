<?php
require "../clases/AutoCarga.php";
$session=new Session();
$bd=new Database();
$gestorPrincipal=new GestorPermisosPrincipal($bd);
$gestorClientes=new GestorClientes($bd);
$gestorUsuarios=new GestorUsuarios($bd);
$gestorUsuariosGrupos=new Gestor_relacion_usuarios_grupos($bd);
$idUsuario=$gestorUsuarios->get($session->get("nombre"))->getId();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=content‐width"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../css/main.css"/>
<link rel="stylesheet" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
<script src="../js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
<script src="../js/ajax.js"></script>
<script src="../js/app.js"></script>
<script src="../js/main.js"></script>
</head>
<body>
     <header> 
                <div class="navegador">
                <div class="item"><a href="../index.php">Inicio</a></div>
                <div class="item"><a href="nosotros.php">Nosotros</a></div>
                <div class="item"><a href="clientes.php">Clientes</a></div>
                <div class="item"><a href="contacto.php">Contacto</a></div>
                </div>
                 
    </header>
<div class="contenedor">
	<div class="slider" id="slider">
				<div id="menu">
					<div id="capaSesion">
					<?php
					//Sesión iniciada
					echo "<p>Sesión iniciada: ";
					echo "<span class='negrita'>".$session->get("nombre")."</span></p>";
					?>
					<form action="../usuarios/phplogout.php" method="POST">
						<input type="submit" class="cierraSesion" name="cerrar" value="Cerrar sesión"/>
					</form>
					</div>
					<div id="flechaIzquierda" class="flecha oculto"><img src="../img/izquierda.png" class="botonMenu"/></div>

					<?php
					$menus=$gestorPrincipal->escribeMenu(1,$idUsuario);
					foreach($menus as $menu){
						echo "<div class='capaMenu'><h4><a href='?id=$idUsuario&menu=".$menu->getAlias()."'>".$menu->getNombre()."</a></h4></div>";
					}
					?>	
				</div>
				<div id="cuerpo" class="mayor">
                    <div id="flechaDerecha" class="flecha"><img src="../img/derecha.png" class="botonMenu"/></div>
					<?php
					$cuerpo="";
					$cuerpo="<div id='fondo'><img src='../img/fondo2.png' class='imgFondo'/></div><div id='fondoDos'></div>";
					if (Request::req("menu")){
						switch(Request::req("menu")){
							case "usuarios":
									if($gestorUsuariosGrupos->esAdmin($idUsuario)){
										$cuerpo=$gestorPrincipal->escribeTablaUsuarios();
									}

							break;		
							case "clientes":
									$cuerpo=$gestorPrincipal->escribeClientes();
							break;
							case "estadisticas_clientes":
							break;
							case "webs":
								    $cuerpo=$gestorPrincipal->escribeWebs($idUsuario);
							break;
							case "cuentas":
									$cuerpo=$gestorPrincipal->escribeTablaCuentas($idUsuario);
							break;
                            case "acciones":
                                    $cuerpo=$gestorPrincipal->escribeTablaAcciones($idUsuario);
                            break;
							default:
								$cuerpo="<div class='fondoClaro'><h1>Bienvenido al gestor</h1></div>";
								break;
						}	
					}
					echo $cuerpo;
				?>
			</div>
          <div class="footer">
            <div class="itemfooter">
                <div>
                <h2>INFORMACIÓN LEGAL</h2>
                            <p><a href="#">Aviso legal</a></p>
                            <p><a href="#">Política de privacidad</a></p>
                            <p><a href="#">Política de cookies</a></p>
                            <p><a href="#">Información general</a></p>
                </div>
             </div>
            <div class="itemfooter">
                <div>
                <h2>¿DÓNDE ESTAMOS?</h2>
                    <p>Calle Acera del Darro, 72</p>
                    <p>18005 Granada, España</p>
                    <p>Tfno: 657071575</p>
                    <p>sfiseo@gmail.com</p>
                </div>
            </div>
            <div class="itemfooter">
                <div>
               <h2>DE INTERÉS</h2>
                    <p><a href="http://www.sidn.es/noticias/600-factores-de-seo-on-page-que-debes-mimar-al-maximo">Factores de SEO que debes mimar.</a></p>
                    <p><a href="http://www.sidn.es/noticias/588-las-10-tendencias-en-marketing-digital-mas-importantes-del-2016">Tendencias en marketing digital 2016.</a></p>
                    <p><a href="http://www.sidn.es/noticias/583-asi-es-la-reputacion-online-de-los-candidatos-a-la-presidencia-del-gobierno">Reputación online candidatos elecciones.</a></p>
                    <p><a href="http://www.sidn.es/noticias/554-inbound-marketing-y-gestion-de-reputacion-corporativa-online">Inboud marketing y reputación corporativa.</a></p>
                </div>
            </div>
            <div class="ult">
                <div class="redesfooter"><span><a href="#">M P N Q O W</a></span></div>
                <div class="copy"><span>Copyright 2016. SFI</span></div>
            </div>
        
        </div>
</div>
</body>
</html>