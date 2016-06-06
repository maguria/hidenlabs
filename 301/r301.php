<?php
require '../clases/AutoCarga.php';
$sesion=new Session();
$r="Redirect 301";
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=content‐width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript"> 

function copia_portapapeles(){ 
    document.f1.textarea.select();
	document.execCommand("copy"); 
} 
</script>

<link rel="stylesheet" href="../css/301.css"/>
<link rel="stylesheet" href="../css/main.css"/>
<link rel="stylesheet" href="../css/bootstrap.css"/>
<link rel="stylesheet" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" href="../css/bootstrap-theme.css"/>
<link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
</head>
<body>
    <header>
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
                    if($sesion->get("nombre")==""){
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
                        <a href="../menus/principal.php">Gestor</a>
                    </div>
                <?php
                }
                ?>
                <div class="item"><a href="../index.php">Inicio</a></div>
                <div class="item"><a href="../menus/nosotros.php">Nosotros</a></div>
                <div class="item"><a href="../menus/clientes.php">Clientes</a></div>
                <div class="item"><a href="../menus/contacto.php">Contacto</a></div>
                </div>
                
    </header>
<div class="cont">
<div class="fondo301"><img src="../img/fondoprincipal.png"/></div>
<div class="engloba">
<div class="capaform">
    
<div class='table-responsive'>
    <div class='titulo'><h2>Sube tu archivo csv</h2></div>
<form method="post" action="#" enctype="multipart/form-data"/>
<table class='csv'>
<tr><td class="tdizqda"><label>Archivo csv: </label></td><td><input type="file" name="csv" value="Archivo csv" class="boton1" required/></td></tr>
    <tr><td><label>Selecciona: </label></td>
    <td><select name="httppi"><option value="HTTP">http</option>
				<option value="HTTPS">https</option></select>
        <select name="wwwpi"><option name="www" value="www.">WWW</option>
				<option name="www" value="">SIN WWW</option></select></td></tr>
<tr><td><label>URL (Prefijo inicial): </label></td><td><input type="text" name="prefijoini" required></td></tr>
<tr><td><label>Selecciona: </label></td>
    <td><select name="httppf"><option value="HTTP">http</option>
				<option value="HTTPS">https</option></select>
        <select name="wwwpf"><option name="www" value="www.">WWW</option>
				<option name="www" value="">SIN WWW</option></select></td></tr>
<tr><td><label>URL (Prefijo final): </label></td><td><input type="text" name="prefijofin" required></td></tr>
 <tr><td colspan=2 class="boton"><input type="submit" name="enviar" value="Escribir" class="enviar301" id="enviar301"/></td></tr>
 </table>
</form>
</div>
</div>

<?php
if(Request::post("enviar")){
	$f=$_FILES["csv"];
	$d='"'.Request::post("delim").'"';
    $pi=Request::post("prefijoini");
	$hi=Request::post("httppi");
	$wi=Request::post("wwwpi");
    $hf=Request::post("httppf");
	$wf=Request::post("wwwpf");
	$pf=Request::post("prefijofin");
	$fp = fopen('data.txt', 'w');
	

?>
    <div class="capaform separar">
        <h2>Redirecciones</h2>
    <form name="f1"> 
    <textarea rows="17" cols="80" name="textarea" id="textarea301" class="table-responsive">
<?php
	if (($fichero = fopen($f["tmp_name"], "r")) !== FALSE) {
        while (($datos = fgetcsv($fichero, 0,"\t")) !== FALSE) {
        	$resdatos=substr($datos[0],0,strlen($pi));
        	if($pi==$resdatos){
        	$cv=substr($datos[0],strlen($pi));
           }
           else{
           	$cv=$datos[0];
           }
           if($cv!="'\'"){
           		echo $r." ".$hi."://".$wi."".$pi."".$cv." ".$hf."://".$wf."".$pf."".$cv."\n"; 
           }
			

   	   }
   	   fclose($fp);	
?>
	</textarea>
        <div class="boton"><input type="button" class="enviar301" onclick="copia_portapapeles()" value="Copiar" /></div></form>
<?php  
	}
}

?>
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


