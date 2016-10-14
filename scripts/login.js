$(document).ready(function () {    
    $("#btn_autenticar").on("click", validar_autenticacion);
    
    $('#btn-restablecer').click(function(){
        var url='../controllers/sis/restablecerContrasena.php';
        var data = {correo_electronico:$('#correo_electronico').val()};
        $.post(url,data,function(response) {
            //console.log("response:"+response.trim() ); 
            if(response.trim() === "SENT"){
                $('#modalpasswordreset').modal('hide');
                alert('Se ha restablecido la contraseña, por favor revise su correo electrónico');
            }else{
               alert(response.trim());
               //$('#modalpasswordreset').modal('hide');
            }
        });  
        
    });
    
});

function validar_autenticacion(e){
    e.preventDefault();
    
    $("#contenedor_warning").hide();
    $("#mensaje_warning").html("");

    $("#contenedor_danger").hide();
    $("#mensaje_danger").html("");

    console.log('username:'+$("#username").val()+' password:'+$("#password").val())
    if($("#username").val()=="" || $("#password").val()==""){
        console.log('opt 1');
        $("#contenedor_warning").show();
        $("#mensaje_warning").html('Por favor ingrese Usuario y Contraseña.');
        $("#username").focus();
    }
    else
    {
        //$("#formulario_autenticacion").attr("action")
        console.log('opt 2; url:'+$("#formulario").attr( 'action' ));
        $.post($("#formulario").attr('action'),$("#formulario").serializeArray(),
            function(data) {
                console.log("data:"+data.trim() );
                if (data.trim() == 'Aceptada')
                {
                    $(location).attr('href',"../controllers/inicio.php");
                }
                else{
                    $("#contenedor_danger").show();
                    $("#mensaje_danger").html(data.trim());
                }
            }
        );
    }
};
