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
                <div class="item activo"><a href="nosotros.php">Nosotros</a></div>
                <div class="item"><a href="clientes.php">Clientes</a></div>
                <div class="item"><a href="contacto.php">Contacto</a></div>
                </div>
            <div class="cuerpoPagina">
                <div class="fondoindex"><img src="../img/fondonosotros.png"/></div>
                <div class="engloba">
                    <div class="itemnosotros">
                        <h1>¿Quiénes somos? <img src="../img/nosotros.png" class="iconoNosotros"/></h1>
                        <p>Somos un equipo formado por 22 profesionales repartidos en diferentes áreas. Nuestra especialidad es el posicinamiento web SEO y técnicas de reputación online, aunque para llevarlas a cabo es necesario el aporte de otras disciplinas, como son el diseño gráfico, desarrollo web, así como publicidad y marketing.</p>
                        <p>En nuestras filas contamos con dos administrativos, cuatro desarrolladores web, cuatro diseñadores gráficos, tres expertos en publicidad y social media, cinco expertos en reputación online y cuatro dedicados al posicionamiento SEO.</p>
                        <p>Somos un equipo joven, ambicioso, movido por el afán de aprendizaje y superación en cada momento, intentando siempre ofrecer lo mejor de nosotros mismos y amantes de la perfección.</p>
                        <p>Somos once y once, chicos y chicas por igual, para hacer tus sueños realidad.</p>
                    </div>
                    <div class="itemnosotros"> <img src="../img/equipo.png"/></div>
                    <div class="itemnosotros gala"> <img src="../img/gala.png"/></div>
                    <div class="itemnosotros"> <img src="../img/equipopremios.png"/></div>
                    <div class="itemnosotros"> <h2>Search Awards 2016 <img src="../img/trofeo.png" class="iconoNosotros"/></h2><p>El pasado 24 de marzo se anunciaban los nominados a los European Search Awards 2016, unos premios europeos que, desde 2012, reconocen la labor de agencias y expertos en marketing digital dentro del ámbito del marketing en buscadores.</p>
                    <p>En SFI, tenemos el placer de anunciar que, un año más, contamos con varias nominaciones para estos premios que tantas alegrías nos han dado.</p>
                    <p>En 2014, SFI fue la única agencia SEO española nominada en estos premios. En 2015, fuimos nominados como “Mejor agencia de marketing digital”, como “Mejor campaña de mobile marketing” y como “mejor campaña SEO de bajo presupuesto”.
Este año, nuestras nominaciones han ido en aumento y la relevancia de las mismas es aún mayor dentro del sector del marketing digital y el SEO.</p>
                    </div>
                    
                </div>
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
