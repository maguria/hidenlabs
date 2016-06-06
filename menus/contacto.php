<?php
require "../clases/AutoCarga.php";
$session=new Session();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=content‐width"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../css/main.css"/>
<link rel="stylesheet" href="../css/bootstrap.css"/>
<link rel="stylesheet" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" href="../css/bootstrap-theme.css"/>
<link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwNN9HTq5uDJlMzO4KtSDosiNlppcxO2k"></script>
<script src="../js/map.js"></script>
</head>
<body>
    <div class="wrapper">
                <div class="logo" id="logo"><img src="../img/logo.png" /></div>
                <div class="logo" id="logomovil"><img src="../img/logomovil.png" /></div>  
                <?php
                        $resultadoLogin=Request::get("r");
                        if($resultadoLogin==-1){
                    ?>
                        <div class="mensajeLogin">
                    <?php
                            echo "Datos incorrectos";
                        }
                    ?>	
                       </div>
                <div class="navegador">
                    <?php
                    if($session->get("nombre")==""){
                    ?>
                <div class='item itemformu'><form method="POST" action="../usuarios/phplogin.php">
                   <input type="text" name="nombre" placeholder="Nombre de usuario" required/>
                    <input type="password" name="password" placeholder="Contraseña" required/>
                    <input type="submit" name="login" value="Login" class='btnFormu'/></td></tr></form>
                </div>
                <?php
                }
                else{
                    ?>
                    <div class='item itemGestor'>
                        <a href="principal.php">Gestor</a>
                    </div>
                <?php
                }
                ?>
                <div class="item"><a href="../index.php">Inicio</a></div>
                <div class="item"><a href="nosotros.php">Nosotros</a></div>
                <div class="item"><a href="clientes.php">Clientes</a></div>
                <div class="item activo"><a href="contacto.php">Contacto</a></div>
                </div>
    <div class="cuerpoPagina">
    <div class="fondopez"><img src="../img/fondopez.jpg"/></div>
    <div class="engloba">
         <div id="seccioncontacto">
                <form id="formu">
                        <input type="text" name="name" id="name" value="" class="input" placeholder="Nombre" /><br/>
                        <input type="text" name="email" id="email" value="" class="input" placeholder="Email" /><br/>
                        <textarea rows="11" name="message" id="message" class="input" placeholder="Dudas y sugerencias"></textarea><br/>
                        <div class="enviar">
                            <input type="submit" value="Enviar" name="submit" id="submit" class="botoncontacto" />
                        </div>

                </form>
            </div>
            <div id="mapa"></div>
    </div>
        <div class="itemredes"><h2>Síguenos en las redes sociales</h2></div>
        <div class="itemredes"><span><a href="https://www.facebook.com/" id="facebook">M</a></span><span><a href="https://www.instagram.com/" id="instagram"> P</a></span><span><a href="https://www.twitter.com/" id="twitter"> N </a></span><span><a href="https://www.pinterest.com/" id="pinterest">Q </a></span><span><a href="https://plus.google.com/" id="google">O</a></span></div>
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
