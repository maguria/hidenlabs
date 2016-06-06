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
<script src="../js/jquery-2.2.3.min.js"></script>
<script src="../js/main.js"></script>
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
                <div class="item activo"><a href="clientes.php">Clientes</a></div>
                <div class="item"><a href="contacto.php">Contacto</a></div>
                </div>
                <div class="cuerpoPagina">
                    <div class="fondoclientes"><img src="../img/fondoclientes.png"/></div>
                    <div class="engloba englobaClientes">
                        <div id="fondoModal" class="fondoModal oculto"> </div>
                            <div id="vmodal" class="vmodal oculto">
                            <div id="btnCierraModal"><img src="../img/clientes/cierraModal.png"/></div>
                            <div id="imagenEmpresa"></div>
                            <div id="definicionEmpresa"></div>
                        </div>
                        <div class="logosClientes">
                         <div class="itemclientes" data-img="alberto" data-def="Llevamos el desarrollo y el posicionamiento SEO de Alberto Soto desde hace 6 meses. Recientemente hemos empezado también con la reputación online, así como campañas de social media. Ya estamos viendo los resultados positivos."><img src="../img/clientes/alberto.png"/></div>
                         <div class="itemclientes" data-img="alhambra"  data-def="Primera marca de cerveza en Granada, Alhambra ha confiado en nosotros para sus campañas de publicidad y marketing, así como en el posicionamiento SEO y reputación online desde el año 2000." ><img src="../img/clientes/alhambra.png"/></div>
                         <div class="itemclientes" data-img="armentia" data-def="Armentia Consultores es una de las principales empresas de consultoría de España. nos confió la reputación online, obteniendo con ello un incremento de un 15% en suscripciones y una disminución considerable de comentarios negativos en la web."><img src="../img/clientes/armentia.png"/></div>
                         <div class="itemclientes" data-img="axa" data-def="Axa es una de las empresas de seguros más importantes de nuestro país, con cerca de dos millones de clientes. Estamos orgullosos de trabajar con ellos ofreciéndoles nuestros conocimientos en SEO y reputación online, así como distintas campañas de publicidad."><img src="../img/clientes/axa.png"/></div>
                         <div class="itemclientes" data-img="bankinter" data-def="Asesoramos en posicionamiento SEO para Bankinter desde hace ya muchos años, uno de los principales bancos españoles, recientemente estamos cerrando acuerdos para llevar la publicidad y la reputación online. "><img src="../img/clientes/bankinter.png"/></div>
                         <div class="itemclientes" data-img="bbva" data-def="Asesoramos también en posicionamiento SEO a BBVA desde hace ya muchos años, uno de los principales bancos españoles. Debido a nuestra campaña de reputación online los comentarios positivos en la web se han incrementado, consiguiendo un considerable número de altas. "><img src="../img/clientes/bbva.png"/></div>
                         <div class="itemclientes" data-img="company" data-def="Company es un grupo multimedia español con sede en Barcelona (España) que opera en los sectores editorial, audiovisual y de comunicación. Nuestra labor con ellos se centra en el posicionamiento SEO y campañas de marketing."><img src="../img/clientes/company.png"/></div>
                         <div class="itemclientes" data-img="estrella" data-def="Empresa cervecera ubicada en la región de Murcia que ha confiado en nosotros para sus campañas de publicidad. También hemos sido elegidos para el desarrollo de su web, así como su posicionamiento en buscadores."><img src="../img/clientes/estrella.png"/></div>
                         <div class="itemclientes" data-img="hm" data-def="H & M es una de las franquicias de ropa juvenil más importantes de nuestro país, con sede en prácticamente todas las provincias y han depositado su confianza en nosotros en cuanto al posicionamiento SEO y la reputación online."><img src="../img/clientes/hm.png"/></div>
                         <div class="itemclientes" data-img="ibermon" data-def="Ibermon Instalaciones Industriales S.A también confía en nosotros. Trabajamos con ellos las campañas publicitarias, redes sociales, posicionamiento SEO y reputación online."><img src="../img/clientes/ibermon.png"/></div>
                         <div class="itemclientes" data-img="imagina" data-def="Imagina escuela de creatividad infantil ha delegado en nosotros su publicidad. Llevamos a cabo campañas en redes sociales, concursos, así como posicionamiento SEO y técnicas de reputación online."><img src="../img/clientes/imagina.png"/></div>
                         <div class="itemclientes" data-img="opel" data-def="Está entre las principales compañías automotrices en términos de producción anual de vehículos. Desde 1999 trabajamos con ellos perfeccionando el SEO, así como la reputación online en buscadores."><img src="../img/clientes/opel.png"/></div>
                         <div class="itemclientes" data-img="oz" data-def="Oz grupo editorial lleva a cabo multitud de campañas en redes sociales en busca de talento novel. Han confiado en nosotros para dar rienda a esas campañas adaptándolas al diseño actual. Trabajamos también su posicionamiento web y su reputación online."><img src="../img/clientes/oz.png"/></div>
                         <div class="itemclientes" data-img="puleva" data-def="PULEVA te ofrece la leche con mejor calidad nutricional, adaptada a tus necesidades específicas según tu momento vital. Y han confiado en nosotros para formar parte de su proyecto, relanzándolo gracias a nuestras técnicas de SEO, publicidad y marketing."><img src="../img/clientes/puleva.png"/></div>
                         <div class="itemclientes" data-img="servibar" data-def="Servibar se ha consolidado como una de las mayores empresas españolas en cuanto al servicio hotelero se refiere. Llevamos sus campañas publicitarias, actualizaciones de web, contenidos y posicionamiento SEO y reputación online."><img src="../img/clientes/servibar.png"/></div>
                         <div class="itemclientes" data-img="starbucks" data-def="Empresa estadounidense repartida por todo el globo terrestre. No hay nadie que no haya oído hablar de Starbucks o haya probado sus deliciosos cafés. Depositan su confianza en nosotros en 2003 para llevar a cabo técnicas de reputación online en nuestro país, así como algunas de sus campañas publicitarias."><img src="../img/clientes/starbucks.png"/></div>
                </div>
                <div class="sidebarClientes">
                    <div class="contieneListaClientes">
                    <ul class="urlEmpresas">
                        <li><a href="http://www.albertosoto.es/">Alberto Soto</a></li>
                        <li><a href="http://www.cervezasalhambra.es/">Alhambra</a></li>
                        <li><a href="http://www.armentia.toyota.es/">Armentia</a></li>
                        <li><a href="http://www.axa.es/">AXA</a></li>
                        <li><a href="http://www.bankinter.com/">Bankinter</a></li>
                        <li><a href="http://www.bbva.es/">BBVA</a></li>
                        <li><a href="http://www.company.com/">Company</a></li>
                        <li><a href="http://www.estrelladelevante.es/">Estrella</a></li>
                        <li><a href="http://www.hm.com/">H & M</a></li>
                        <li><a href="http://www.axesor.es/">Ibermon</a></li>
                        <li><a href="https://imaginaescuelacreativa.wordpress.com/">Imagina</a></li>
                        <li><a href="http://www.opel.es/">Opel</a></li>
                        <li><a href="http://www.ozeditorial.com/">Oz</a></li>
                        <li><a href="http://www.puleva.es/">Puleva</a></li>
                        <li><a href="http://www.servibar.es/">Servibar</a></li>
                        <li><a href="http://www.starbucks.es/">Starbucks</a></li>
                    </ul>
                    </div>
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
