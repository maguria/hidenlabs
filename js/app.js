"use strict";
jQuery(document).ready(function(){
   
   //Devuelve un cliente con sus tipos de acciones
    function getClienteAcciones(idCliente){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_clientes'></div><div class='capasTres' id='contenedora_tipos_accion'></div><div class='capasTres oculto' id='contenedora_acciones'></div>");
        $("#cuerpo").html(div);
        $("#cuerpo").removeClass("centrado");
        $("#cuerpo").toggleClass("completa");
        var procesarRespuesta = function(respuesta) {
            var cliente = respuesta.cliente;
            var tipos=respuesta.tiposAcciones;
            var texto="<div class='nombreTabla'><h1>Cliente</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            texto+="<tr><td><img src='.."+cliente.imagen+"' class='imagenCliente'/></td></tr>";
            texto+="<tr><td><h2>"+cliente.nombre+"</h2></td></tr>";
            texto+="</table></div>";
            var texto2="<div class='nombreTabla'><h1>Departamentos</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            for(var i = 0; i < tipos.length; i++) {
                texto2 += "<tr><td class='contImgTipoAccion'><img src='../img/"+tipos[i].clase_css+".png' class='imagenTipoAccion'></td><td><h2 class='enlaceTipoAccion' id='enlace"+idCliente+"_"+tipos[i].id+"' name='"+idCliente+","+tipos[i].id+"'>"+tipos[i].nombre+"</h2></td></tr>";
            }
            texto2+="</table></div>";
            $("#contenedora_tipos_accion").html(texto2);
            $("#contenedora_clientes").html(texto);
        };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxClientes.php?idCliente='+idCliente,procesarRespuesta);
    };

     jQuery(".enlaceCliente").on('click',function(){
        var idCliente=$(this).attr("name");
        getClienteAcciones(idCliente);
    });
     //Devuelve las acciones de un tipo de acción y cliente determinados
    function getAcciones(idCliente,idTipo) {
        var procesarRespuesta = function(respuesta) {
            var acciones=respuesta.acciones;
            var texto="<div class='nombreTabla'><h1>Tareas</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            for(var i = 0; i < acciones.length; i++) {
                texto +="<tr><td><span class='nombreAcciones'>"+acciones[i].nombre+"</span>&nbsp;&nbsp;<span class='btnCompleta'><input type='button' class='btnCompletar' id='"+acciones[i].id+"' data-idCliente='"+idCliente+"' data-idTipo='"+idTipo+"' value='Completar'></span></td></tr>";
            }
            texto+="</table></div>";
            if($('#mensajeCompletar').attr("data-mensaje")==undefined){
                texto+="<div id='mensajeCompletar' data-mensaje=''></div>";
            }
            else{
                
                texto+="<div id='mensajeCompletar' data-mensaje=''>"+$('#mensajeCompletar').attr("data-mensaje")+"</div>";
            }
            $("#contenedora_acciones").removeClass("oculto");
            $("#contenedora_acciones").html(texto);
        };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxAcciones.php?idTipo='+idTipo+'&idCliente='+idCliente,procesarRespuesta);
    };
    jQuery("#cuerpo").on('click',".enlaceTipoAccion",function(){
        var cad1 = $(this).attr("name").split(' ');
        var cad2 = cad1[0].split(',');
        var idCliente=cad2[0];
        var idTipo=cad2[1];
        getAcciones(idCliente,idTipo);
    });
    
    function completaAcciones(idAccion,idCliente,idTipo){
        var procesarRespuesta = function(respuesta) {
                var mensaje=respuesta.mensaje;
                var texto=mensaje;
                $('#mensajeCompletar').attr("data-mensaje",texto);
         };
         var ajax = new Ajax();
         ajax.setPost();
         ajax.doFast('../ajax/ajaxCompletaAccion.php?idAccion='+idAccion+'&idCliente='+idCliente+'&idTipo='+idTipo,procesarRespuesta);
        };
        jQuery("#cuerpo").on('click',".btnCompletar",function(){
        var idAccion = $(this).attr("id");
        var idCliente= $(this).attr("data-idCliente");
        var idTipo=$(this).attr("data-idTipo");
        completaAcciones(idAccion);
        getAcciones(idCliente,idTipo);
    });


    //Devuelve las cuentas según la web
    function getCuentasPorWeb(idWeb){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_web'></div><div class='capasTres' id='contenedora_cuentas'></div>");
        $("#cuerpo").html(div);
        $("#cuerpo").removeClass("centrado");
        $("#cuerpo").toggleClass("completa");
        
         var procesarRespuesta = function(respuesta) {
            var texto="";
            var nombreWeb=respuesta.nombreWeb;
            var urlWeb=respuesta.urlWeb;
            var imagenWeb=respuesta.imagenWeb;
            var descripcionWeb=respuesta.descripcionWeb;
            var cuentas=respuesta.cuentas;
            var texto="<div class='nombreTabla'><h1>Web</h1></div><table class='tablaCapasTres'>";
            texto+="<tr><td><img src='.."+imagenWeb+"'/></td></tr>";
            texto+="<tr><td><h2>"+nombreWeb+"</h2></td></tr>";
            texto+="<tr><td><h3>"+urlWeb+"</h3></td></tr>";
            texto+="<tr><td><h4>"+descripcionWeb+"</h4></td></tr>";
            texto+="</table>";
            var texto2="<div class='nombreTabla'><h1>Cuentas</h1></div><table class='nombreCuentas'>";
            for(var i = 0; i < cuentas.length; i++) {
                texto2 += "<tr><td><span class='capaImagenCuenta'><img src='../img/"+cuentas[i].clase_css+".png' class='imagenCuenta'></span><span><h3><span class='enlaceCuenta' name='"+cuentas[i].id+"'>"+cuentas[i].usuario+"</h3>";
                if(cuentas[i].tipo_web==1){
                    texto2+="<form method='POST' target='_blank' action='"+cuentas[i].url_acceso+"'><input type='hidden' name='"+cuentas[i].id_input_usuario+"' value='"+cuentas[i].usuario+"'/><input type='hidden' name='"+cuentas[i].id_input_password+"' value='"+cuentas[i].password+"'/><input type='submit' name='accedeWeb' value='Acceder'/></form>";
                }
                texto2+="<div class='inputClave'><input type='password' value='"+cuentas[i].password+"' id='claveCuenta_"+cuentas[i].id+"' class='claveCuenta'/><input type='button' value='Copiar clave' data-id="+cuentas[i].id+" id='copiaClave_"+cuentas[i].id+"' class='copiaClave'/></div></span></td></tr>";
            }
            texto2+="</table>";
            $("#contenedora_web").html(texto);
            $("#contenedora_cuentas").html(texto2);
        };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxCuentasPorWeb.php?idWeb='+idWeb,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceWeb",function(){
        var idWeb=$(this).attr("name");
        getCuentasPorWeb(idWeb);
    });

    //Nos devuelve un usuario con la tabla para editarlo
    function getUsuario(idUsuario){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_usuario'></div><div class='capasTres' id='contenedora_datos_usuario'></div>");
        $("#cuerpo").html(div);
         var procesarRespuesta = function(respuesta) {
            var texto="<div class='nombreTabla'><h1>Usuario</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            var usuario=respuesta.usuario;
            var tabla=respuesta.tabla;
            texto +="<tr><td><img src='.."+usuario.imagen+"'/></td></tr>";
             texto +="<tr><td><h2>"+usuario.nombre+"</h2></td></tr></table></div>";
            $("#contenedora_usuario").html(texto);
            var texto2=escribeTablaEdicion(usuario,tabla);

             $("#contenedora_datos_usuario").html(texto2);
         };
         var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxUsuarios.php?idUsuario='+idUsuario,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceEditaUsuario",function(){
        var idUsuario=$(this).attr("name");
        getUsuario(idUsuario);
    });

    //Función que escribe la tabla de edición
     function escribeTablaEdicion(datosTabla,nombreTabla=""){
        var texto="<div class='nombreTabla'><h1>Edita "+nombreTabla+"</h1></div><div class='formulario_"+nombreTabla+" formulario_modificacion_generico'>";
        for (var i in datosTabla){
            texto+="<span class='label_formulario col-xs-12 col-sm-4 col-md-3 col-lg-3'>"+i+"</span><span class='inputSpan col-xs-12 col-sm-8 col-md-9 col-lg-9'><input type='text' class='input_formulario' name='"+i+"' value='"+datosTabla[i]+"'/></span>";
        }
        texto+="<input type='button' class='btnEditar"+nombreTabla+" btnEditar' name='"+datosTabla.id+"' value='Editar'/>";
        texto+="<div class='mensaje'><span id='mensajeEditar'></span></div>";
        texto+="<img src='../img/back.png' class='volver'/>";
        texto+="</div>";
        return texto;
    }
    function botonInsercion(nombreTabla=""){
        var texto="";
        texto+="<input type='button' class='btnInserta"+nombreTabla+" btnInsertar' value='Insertar'/>";
        texto+="<div class='mensaje'><span id='mensajeInsertar'></span></div>";
         texto+="<img src='../img/back.png' class='volver'/>";
        return texto;
    }

    //Función que escribe la tabla de inserción 
    function escribeTablaInsercion(datosTabla,nombreTabla=""){
        var texto="<div class='formulario_"+nombreTabla+" formulario_insercion_generico'>";
        texto+="<h3 class='nombreInsercion'>Inserta "+nombreTabla+"</h3>";
        for (var i in datosTabla){
            texto+="<span class='label_formulario col-xs-12 col-sm-4 col-md-3 col-lg-3'>"+i+"</span><span class='inputSpan col-xs-12 col-sm-8 col-md-9 col-lg-9'><input type='text' class='input_formulario' name='"+i+"' value=''/></span>";
        }
        texto+="</div>";
        return texto;
    }
    
    //Nos devuelve una cuenta con la tabla para editarla
    function getCuenta(idCuenta){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_cuenta'></div><div class='capasTres' id='contenedora_datos_cuenta'></div>");
        $("#cuerpo").html(div);
         var procesarRespuesta = function(respuesta) {
             var cuenta=respuesta.cuenta;
             var tabla=respuesta.tabla;
             var tipo=respuesta.tipo;
             var url=respuesta.url;
             var texto="<div class='nombreTabla'><h1>Cuenta</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
              texto+="<img src='../img/"+tipo.clase_css+".png' class='imagenCuenta'/>";
              texto +="<tr><td><h4>"+tipo.nombre+"</h4></td></tr>";
              texto +="<tr><td><h2>"+cuenta.usuario+"</h2></td></tr>";
              texto +="<tr><td class='nombreTabla web'><h3>Web</h3></td></tr>";
              texto+="<tr><td><h4>"+url+"</h4></td></tr></table></div>";
            $("#contenedora_cuenta").html(texto);
            var texto2=escribeTablaEdicion(cuenta,tabla);

             $("#contenedora_datos_cuenta").html(texto2);
         };
         var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxCuentas.php?idCuenta='+idCuenta,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceEditaCuenta",function(){
        var idCuenta=$(this).attr("name");
        getCuenta(idCuenta);
    });
    //Nos devuelve una web con la tabla para editarla
    function getWeb(idWeb){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_web'></div><div class='capasTres' id='contenedora_datos_web'></div>");
        $("#cuerpo").html(div);
         var procesarRespuesta = function(respuesta) {
            var texto="<div class='nombreTabla'><h1>Web</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            var web=respuesta.web;
            var tabla=respuesta.tabla;
            texto +="<tr><td><img src='.."+web.imagen+"'/></td></tr>";
             texto+="<tr><td><h2>"+web.nombre+"</h2></td></tr></table></div>";
            $("#contenedora_web").html(texto);
            var texto2=escribeTablaEdicion(web,tabla);

             $("#contenedora_datos_web").html(texto2);
         };
         var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxWeb.php?idWeb='+idWeb,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceEditaWeb",function(){
        var idWeb=$(this).attr("name");
        getWeb(idWeb);
    });
    
    //Nos devuelve un cliente con la tabla para editarla
    function getCliente(idCliente){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_cliente'></div><div class='capasTres' id='contenedora_datos_cliente'></div>");
        $("#cuerpo").html(div);
         var procesarRespuesta = function(respuesta) {
            var texto="<div class='nombreTabla'><h1>Cliente</h1></div><div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            var cliente=respuesta.cliente;
            var tabla=respuesta.tabla;
            texto +="<tr><td><img src='../"+cliente.imagen+"'/></td></tr>";
             texto +="<tr><td><h2>"+cliente.nombre+"</h2></td></tr></table></div>";
            $("#contenedora_cliente").html(texto);
            var texto2=escribeTablaEdicion(cliente,tabla);

             $("#contenedora_datos_cliente").html(texto2);
         };
         var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxCliente.php?idCliente='+idCliente,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceEditaCliente",function(){
        var idCliente=$(this).attr("name");
        getCliente(idCliente);
    });

    //Edita una cuenta y muestra la respuesta
    function editaCuentas(idCuenta,datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Cuenta editada"){
                $("#mensajeEditar").addClass("rojo");
                $("#mensajeEditar").removeClass("negrita");
            }
            else{
                $("#mensajeEditar").removeClass("rojo");
                $("#mensajeEditar").addClass("negrita");
            }
            $("#mensajeEditar").text(m);

         };
         var ajax = new Ajax();
         ajax.setPost();
         ajax.doFast('../ajax/ajaxEditaCuenta.php?idCuenta='+idCuenta+'&datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnEditarcuentas",function(){
        var idCuenta=$(this).attr("name");
        var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        editaCuentas(idCuenta,arrayCuentas);
    });
    
    //Edita una web y muestra la respuesta
    function editaWeb(idWeb,datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Web editada"){
                $("#mensajeEditar").addClass("rojo");
                $("#mensajeEditar").removeClass("negrita");
            }
            else{
                $("#mensajeEditar").removeClass("rojo");
                $("#mensajeEditar").addClass("negrita");
            }
            $("#mensajeEditar").text(m);

         };
         var ajax = new Ajax();
         ajax.setPost();
         ajax.doFast('../ajax/ajaxEditaWeb.php?idWeb='+idWeb+'&datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnEditarwebs",function(){
        var idWeb=$(this).attr("name");
        var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        editaWeb(idWeb,arrayCuentas);
    });
    
    //Edita un cliente y muestra la respuesta
    function editaCliente(idCliente,datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Cliente editado"){
                $("#mensajeEditar").addClass("rojo");
                $("#mensajeEditar").removeClass("negrita");
            }
            else{
                $("#mensajeEditar").removeClass("rojo");
                $("#mensajeEditar").addClass("negrita");
            }
            $("#mensajeEditar").text(m);

         };
         var ajax = new Ajax();
         ajax.setPost();
         ajax.doFast('../ajax/ajaxEditaCliente.php?idCliente='+idCliente+'&datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnEditarclientes",function(){
        var idCliente=$(this).attr("name");
        var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        editaCliente(idCliente,arrayCuentas);
    });
     //Edita un usuario y muestra el resultado
    function editaUsuario(idUsuario,datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Usuario editado"){
                $("#mensajeEditar").addClass("rojo");
                $("#mensajeEditar").removeClass("negrita");
            }
            else{
                $("#mensajeEditar").removeClass("rojo");
                $("#mensajeEditar").addClass("negrita");
            }
            $("#mensajeEditar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxEditaUsuario.php?idUsuario='+idUsuario+'&datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnEditarusuarios",function(){
        var idUsuario=$(this).attr("name");
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        editaUsuario(idUsuario,arrayCuentas);
    });
     
     //Saca la los campos del usuario en una tabla vacía para insertar
     function getUsuarioInsercion(){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='contenedora_formulario_inserta' id='contenedora_formulario_inserta_usuario'></div>");
        $("#cuerpo").html(div);
        var procesarRespuesta = function(respuesta) {
            var usuario=respuesta.usuario;
            var grupos=respuesta.grupos;
            var texto=escribeTablaInsercion(usuario,"usuarios");
              
             texto+="<span class='label_formulario col-xs-12 col-sm-4 col-md-3 col-lg-3 labelrelacion'>Grupo al que pertenecerá</span> <span class='inputSpan col-xs-12 col-sm-8 col-md-9 col-lg-9'> <select multiple name='selectGrupo'  class='input_formulario selectrelacion'>";
             for(var i=0;i<grupos.length;i++){
                texto+="<option value="+grupos[i].id+">"+grupos[i].nombre+"</option>";
             }
             texto+="</select></span><br/>";
            texto+=botonInsercion("usuarios");
                $("#contenedora_formulario_inserta_usuario").html(texto);
         };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxFormularioInsercion.php',procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',"#btnFormularioInsertarUsuario",function(){
        getUsuarioInsercion();
    });

     //Inserta un usuario y muestra el resultado
     function insertaUsuario(datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Usuario insertado"){
                $("#mensajeInsertar").addClass("rojo");
                $("#mensajeInsertar").removeClass("negrita");
              
            }
            else{
                $("#mensajeInsertar").removeClass("rojo");
                $("#mensajeInsertar").addClass("negrita");
            }
             $("#mensajeInsertar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxInsertaUsuario.php?datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnInsertausuarios",function(){
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla);
        insertaUsuario(arrayCuentas);
    });
     
      //Saca la los campos de cuenta en una tabla vacía para insertar
     function getCuentaInsercion(){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='contenedora_formulario_inserta' id='contenedora_formulario_inserta_cuenta'></div>");
        $("#cuerpo").html(div);
        var procesarRespuesta = function(respuesta) {
            var cuenta=respuesta.cuenta;
             var webs=respuesta.webs;
            var texto=escribeTablaInsercion(cuenta,"cuentas");
             
             texto+="<span class='label_formulario col-xs-12 col-sm-4 col-md-3 col-lg-3 labelrelacion'>Web a la que pertenecerá</span> <span class='inputSpan col-xs-12 col-sm-8 col-md-9 col-lg-9'> <select name='selectWeb' class='input_formulario selectrelacion'>";
             for(var i=0;i<webs.length;i++){
                texto+="<option value="+webs[i].id+">"+webs[i].nombre+"</option>";
             }
             texto+="</select></span><br/>";
            texto+=botonInsercion("cuentas");
             $("#contenedora_formulario_inserta_cuenta").html(texto);
         };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxFormularioInsercion.php',procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',"#btnFormularioInsertarCuenta",function(){
        getCuentaInsercion();
    });

     //Inserta una cuenta y muestra el resultado
     function insertaCuenta(datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Cuenta insertada"){
                $("#mensajeInsertar").addClass("rojo");
                $("#mensajeInsertar").removeClass("negrita");
              
            }
            else{
                $("#mensajeInsertar").removeClass("rojo");
                $("#mensajeInsertar").addClass("negrita");
            }
             $("#mensajeInsertar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxInsertaCuenta.php?datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnInsertacuentas",function(){
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        insertaCuenta(arrayCuentas);
    });
    //Saca la los campos del cliente en una tabla vacía para insertar
     function getClienteInsercion(){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='contenedora_formulario_inserta' id='contenedora_formulario_inserta_cliente'></div>");
        $("#cuerpo").html(div);
        var procesarRespuesta = function(respuesta) {
            var cliente=respuesta.cliente;
            var texto=escribeTablaInsercion(cliente,"clientes");
            texto+=botonInsercion("clientes");
                $("#contenedora_formulario_inserta_cliente").html(texto);
         };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxFormularioInsercion.php',procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',"#btnFormularioInsertarCliente",function(){
        getClienteInsercion();
    });
     //Inserta un cliente y muestra el resultado
     function insertaCliente(datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Cliente insertado"){
                $("#mensajeInsertar").addClass("rojo");
                $("#mensajeInsertar").removeClass("negrita");
              
            }
            else{
                $("#mensajeInsertar").removeClass("rojo");
                $("#mensajeInsertar").addClass("negrita");
            }
             $("#mensajeInsertar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxInsertaCliente.php?datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnInsertaclientes",function(){
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        insertaCliente(arrayCuentas);
    });
    
    //Saca la los campos de la web en una tabla vacía para insertar
     function getWebInsercion(){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='contenedora_formulario_inserta' id='contenedora_formulario_inserta_web'></div>");
        $("#cuerpo").html(div);
        var procesarRespuesta = function(respuesta) {
            var web=respuesta.web;
            var texto=escribeTablaInsercion(web,"webs");
             texto+=botonInsercion("webs");
                $("#contenedora_formulario_inserta_web").html(texto);
         };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxFormularioInsercion.php',procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',"#btnFormularioInsertarWeb",function(){
        getWebInsercion();
    });
    function insertaWeb(datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Web insertada"){
                $("#mensajeInsertar").addClass("rojo");
                $("#mensajeInsertar").removeClass("negrita");
                }
            else{
                $("#mensajeInsertar").removeClass("rojo");
                $("#mensajeInsertar").addClass("negrita");
            }
             $("#mensajeInsertar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxInsertaWeb.php?datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnInsertawebs",function(){
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        insertaWeb(arrayCuentas);
    });
    //Saca la los campos de la acción en una tabla vacía para insertar
     function getAccionInsercion(){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='contenedora_formulario_inserta' id='contenedora_formulario_inserta_accion'></div>");
        $("#cuerpo").html(div);
        var procesarRespuesta = function(respuesta) {
            var accion=respuesta.accion;
            var texto=escribeTablaInsercion(accion,"acciones");
            texto+=botonInsercion("acciones");
             
                $("#contenedora_formulario_inserta_accion").html(texto);
         };
        var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxFormularioInsercion.php',procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',"#btnFormularioInsertarAccion",function(){
        getAccionInsercion();
    });
    //Inserta una acción y muestra el resultado
     function insertaAccion(datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Tarea insertada"){
                $("#mensajeInsertar").addClass("rojo");
                $("#mensajeInsertar").removeClass("negrita");
              
            }
            else{
                $("#mensajeInsertar").removeClass("rojo");
                $("#mensajeInsertar").addClass("negrita");
            }
             $("#mensajeInsertar").text(m);
         };
         var ajax = new Ajax();
        ajax.setPost();
        ajax.doFast('../ajax/ajaxInsertaAccion.php?datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnInsertaacciones",function(){
       var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        insertaAccion(arrayCuentas);
    });
    //Nos devuelve una acción con la tabla para editarlo
    function getAccion(idAccion){
        var div=$("<div id='flechaDerecha' class='flecha'><img src='../img/derecha.png' class='botonMenu'/></div><div class='capasTres' id='contenedora_datos_accion'></div>");
        $("#cuerpo").html(div);
         var procesarRespuesta = function(respuesta) {
            var texto="<div class='englobaTablaCapasTres'><table class='tablaCapasTres'>";
            var accion=respuesta.accion;
            var tabla=respuesta.tabla;
            var texto=escribeTablaEdicion(accion,tabla);
            $("#contenedora_datos_accion").html(texto);
         };
         var ajax = new Ajax();
        ajax.doFast('../ajax/ajaxAccion.php?idAccion='+idAccion,procesarRespuesta);
    }
    jQuery("#cuerpo").on('click',".enlaceEditaAccion",function(){
        var idAccion=$(this).attr("name");
        getAccion(idAccion);
    });
    
     //Edita una accion y muestra la respuesta
    function editaAccion(idAccion,datosTabla){
        var procesarRespuesta = function(respuesta) {
            var m=respuesta.mensaje;
            if(m!="Tarea editada"){
                $("#mensajeEditar").addClass("rojo");
                $("#mensajeEditar").removeClass("negrita");
            }
            else{
                $("#mensajeEditar").removeClass("rojo");
                $("#mensajeEditar").addClass("negrita");
            }
            $("#mensajeEditar").text(m);

         };
         var ajax = new Ajax();
         ajax.setPost();
         ajax.doFast('../ajax/ajaxEditaAccion.php?idAccion='+idAccion+'&datosTabla='+datosTabla,procesarRespuesta);
    }
     jQuery("#cuerpo").on('click',".btnEditaracciones",function(){
        var idAccion=$(this).attr("name");
        var elementos=$('.input_formulario');
        var size = elementos.size();
        var datosTabla=new Object();
       for (var i=0; i<size; i++){
            datosTabla[$(elementos[i]).attr("name")]=$(elementos[i]).val();
        }
        var arrayCuentas=JSON.stringify(datosTabla)
        editaAccion(idAccion,arrayCuentas);
    });

});
