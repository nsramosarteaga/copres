$(document).ready(function () { 
    console.log('mantenimiento ok');
    
    window.Parsley.setLocale('es');
    var url_aplicacion = '../Spanish.json';
	
    $("#listado_eps").dataTable({
        "language": { "url": url_aplicacion },
        "pageLength": 25
    });
    
    $("#listado_cdireccion").dataTable({
        "language": { "url": url_aplicacion },
        "pageLength": 25
    });
    
    $('.input_capital').on('input', function(evt) {
        $(this).val(function (_, val) {
            return val.toUpperCase();
        });
    });
    
    $("#btn_nuevo_eps").click(function(e){ $(location).attr('href','nuevo.php');  });
    
    $("#btn_guardar_eps").click(function(e){
        console.log("nuevo eps");
        e.preventDefault();
        $("#div_success").hide();
        $("#div_error").hide();
        $("#div_loading").show();
        $('#formulario_eps').parsley().validate();
        if (true === $('#formulario_eps').parsley().isValid() ) {
            $.post("epsGuardar.php",$("#formulario_eps").serialize(),null)
            .done(function( response, textStatus, jqXHR ) {
                    response = $.trim(response);
                    console.log("rta:"+response);
                    $("#div_loading").hide();
                    if(response=="OK"){
                            $("#div_success").show();
                            $("#div_formulario").hide();
                    }else{
                            $("#div_error").show();
                            $("#mensaje_error").html(response);
                    }		
            });            
        }else{
            $("#div_loading").hide();
        }
    });
    
    $("#btn_modificar_eps").click(function(e){
        $("#div_success").hide();
        $("#div_error").hide();
        $("#div_loading").show();
        $('#formulario_eps').parsley().validate();

        if (true === $('#formulario_eps').parsley().isValid() ) {
            $.post("epsEditar.php",$("#formulario_eps").serialize(),null)
            .done(function( response, textStatus, jqXHR ) {
                response = $.trim(response);
                console.log("rta:"+response);
                $("#div_loading").hide();
                if(response=="OK"){
                    $("#div_success").show();
                    $("#div_formulario").hide();
                }else{
                    $("#div_error").show();
                    $("#mensaje_error").html(response);
                }		
            });
        }else{
            $("#div_loading").hide();
        }
    });
    
    /*
    var validateFront = function () {
        if (true === $('#formulario_eps').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
        } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
        }
    };
    */
   
    $("#btn_nuevo_cdireccion").click(function(e){ $(location).attr('href','nuevo.php');  });
    
    $("#btn_guardar_cdireccion").click(function(e){
        console.log("nuevo cdireccion");
        e.preventDefault();
        $("#div_success").hide();
        $("#div_error").hide();
        $("#div_loading").show();
        $('#formulario_cdireccion').parsley().validate();
        if (true === $('#formulario_cdireccion').parsley().isValid() ) {
            $.post("cdireccionGuardar.php",$("#formulario_cdireccion").serialize(),null)
            .done(function( response, textStatus, jqXHR ) {
                response = $.trim(response);
                console.log("rta:"+response);
                $("#div_loading").hide();
                if(response=="OK"){
                    $("#div_success").show();
                    $("#div_formulario").hide();
                }else{
                    $("#div_error").show();
                    $("#mensaje_error").html(response);
                }		
            });
        }else{
            $("#div_loading").hide();
        }
    });
    
   $("#btn_modificar_cdireccion").click(function(e){
        $("#div_success").hide();
        $("#div_error").hide();
        $("#div_loading").show();
        $('#formulario_cdireccion').parsley().validate();

        if (true === $('#formulario_cdireccion').parsley().isValid() ) {
            $.post("cdireccionEditar.php",$("#formulario_cdireccion").serialize(),null)
            .done(function( response, textStatus, jqXHR ) {
                response = $.trim(response);
                console.log("rta:"+response);
                $("#div_loading").hide();
                if(response=="OK"){
                    $("#div_success").show();
                    $("#div_formulario").hide();
                }else{
                    $("#div_error").show();
                    $("#mensaje_error").html(response);
                }		
            });
        }else{
            $("#div_loading").hide();
        }
    }); 
    
});

function modificarEPS(eps_id){
    console.log($('#form_editar_'+eps_id));
    $('#form_editar_'+eps_id).submit();
}


function eliminarEPS(eps_id){
    var r = confirm("¿Esta seguro de eliminar la eps?");
    if (r == true) {
        //alert('eliminar ID ' + eps_id);
        $.post("epsEliminar.php",{ eps_id : eps_id }, function( response ) {
            response = $.trim(response);
            if(response==="OK"){				
                alert("La EPS se ha eliminado exitosamente.");
                $(location).attr('href','index.php');				
            }else{
                alert(response);				
            }
        });
    } else {
        return false;
    }
}

function modificarCdireccion(cdi_id){
    console.log($('#form_editar_'+cdi_id));
    $('#form_editar_'+cdi_id).submit();
}

function eliminarCdireccion(cdi_id){
    var r = confirm("¿Esta seguro de eliminar el barrio o vereda?");
    if (r == true) {
        //alert('eliminar ID ' + eps_id);
        $.post("cdireccionEliminar.php",{ cdi_id : cdi_id }, function( response ) {
            response = $.trim(response);
            if(response==="OK"){				
                alert("EL barrio o vereda se ha eliminado exitosamente.");
                $(location).attr('href','index.php');				
            }else{
                alert(response);				
            }
        });
    } else {
        return false;
    }
}