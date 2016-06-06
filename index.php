<?php
require "clases/AutoCarga.php";
$session=new Session();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=content‐width"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/main.css"/>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
</head>
<body>
      <div class="wrapper">
                <div class="logo" id="logo"><img src="img/logo.png" /></div>
                <div class="logo" id="logomovil"><img src="img/logomovil.png" /></div>  
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
                <div class='item itemformu'><form method="POST" action="usuarios/phplogin.php">
                   <input type="text" name="nombre" placeholder="Nombre de usuario" required/>
                    <input type="password" name="password" placeholder="Contraseña" required/>
                    <input type="submit" name="login" value="Login" class='btnFormu'/></td></tr></form>
                </div>
                <?php
                }
                else{
                    ?>
                    <div class='item itemGestor'>
                        <a href="menus/principal.php">Gestor</a>
                    </div>
                <?php
                }
                ?>
                <div class="item activo"><a href="index.php">Inicio</a></div>
                <div class="item"><a href="menus/nosotros.php">Nosotros</a></div>
                <div class="item"><a href="menus/clientes.php">Clientes</a></div>
                <div class="item"><a href="menus/contacto.php">Contacto</a></div>
                </div>
        <div class="cuerpoPagina">
            <div class="fondoindex"><img src="img/fondoindex.png"/></div>
            <div class="engloba">
            <div id="esquemaseo"><img src="img/esquemaseo.png"/></div>
            <div id="definicion">
                <h2>Agencia digital.</h2>
                <h3>Expertos en Posicionamiento SEO y Reputación Online.</h3>
                <p>Somos una agencia de marketing digital que nace en Granada en el año 2006 como una empresa especializada en aportar soluciones tecnológicas en el ámbito del marketing online y de forma muy especial al posicionamiento seo en buscadores, Google, fundamentalmente, a la gestión de reputación online y a desarrollar estrategias de Marketing online en buscadores.</p>
                <p>En 2014 hemos sido la única agencia SEO española seleccionada en los European Search Awards que son los más prestigiosos premios de marketing en buscadores y posicionamiento SEO a nivel europeo.</p>

                <p>En 2015 también hemos sido seleccionados en los European Search Awards 2015 para "Mejor campaña SEO low budget"  ,"Mejor campaña de marketing mobile" y "Mejor agencia de marketing digital".</p>
            </div>
            </div>
             <div class="engloba englobaindex">
            <div class="itemindex">
                <h2>Reputación online.<img src="img/itemorm.png"/></h2>
                <p>Gestión de reputación online (ORM). Servicios integrados y especializados de reputación online para monitorizar y controlar los resultados de búsqueda de Google o Google Autocomplete. Implementamos y desarrollamos estrategias de Social Media y gestión online de marca mediante Community Managers.</p>
                <p>Trabajamos mediante posicionamiento web contenido no corporativo en Google, así como monitorización, control y modificación de las sugerencias de Google de carácter negativo. Posicionamiento interno en blog, foros, comunidades online, etc.</p>
                <p>Eliminación de visibilidad de entradas negativas, sugerencias negativas de Google Autocomplete e imagen positiva en foros, blogs y entornos 2.0.</p>
            </div>
            <div class="itemindex">
                <h2>Marketing digital.<img src="img/itemmarketing.png"/></h2>
                <p>Agencia de servicios plenos de Marketing digital e inbound marketing a través de estrategias de marketing online mix basadas en seo, reputación de marca online, inbound marketing  y social media marketing, así como publicidad en medios, display, marketing de afiliación, video marketing, Google Adwords y publicidad en todo tipo de redes sociales.</p>
                <p>El core business de nuestra agencia de marketing online es el posicionamiento SEO y en él basamos fundamentalmente nuestras estrategias de marketing online. La visibilidad en Google es la piedra angular de nuestras estrategias de marketing.</p>
            </div>
            <div class="itemindex">
                <h2> Campañas Social Media.<img src="img/itemsocial.png"/></h2>
                <p>Social media Marketing. Dispara tu empresa o marca en el mundo de las redes sociales y controla tu reputación online. Rentabiliza tu presencia en social media a través de una sólida comunidad. Consulta nuestros casos de éxito.</p>
            </div>
            <div class="itemindex">
                <h2>Consultoría SEO.<img src="img/itemseo.png"/></h2>
                <p>Somos expertos en posicionamiento SEO para ecommerce, magento, prestashop, epages o CMS como Joomla o Drupal. Disponemos de una amplia experiencia en integración de campañas de posicionamiento con estrategias multiplataforma y vinculación con estrategias en redes sociales, especialmente Google +, Twitter Pinterest y Linkedin.</p>
                <p>El core business de nuestra agencia SEO es el posicionamiento web, tenemos 12 años de experiencia en consultoría SEO para muchas de las principales empresas de Internet, empresas del IBEX 35, multinacionales y proyectos multilingual y multisignal.</p>
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
