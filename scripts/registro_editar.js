$(document).ready(function () { 
	console.log('registro editar');
	
	window.Parsley.setLocale('es');
	$(function () {
	    $('#datepicker_fn').datepicker({
	    	format: 'dd/mm/yyyy',
	  		language: 'es',
	  		todayHighlight: true
	    });
	    
	    $('#datepicker_ff').datepicker({
	    	format: 'dd/mm/yyyy',
	  		language: 'es',
	  		todayHighlight: true
		});

	});	
	
	
	cargarClasificacionDirecccion($("#cdi_id").val());
	
	$("#btn_modificar").click(function(e){
		e.preventDefault();		
		$("#div_success").hide();
		$("#div_error").hide();
		$("#div_loading").show();
		$('#formulario').parsley().validate();		
			
		
		if (true === $('#formulario').parsley().isValid() ) {
			
			$.post("registroEditar.php",$("#formulario").serialize(),null)
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
  

	var validateFront = function () {
		if (true === $('#formulario').parsley().isValid()) {
			$('.bs-callout-info').removeClass('hidden');
			$('.bs-callout-warning').addClass('hidden');
		} else {
			$('.bs-callout-info').addClass('hidden');
			$('.bs-callout-warning').removeClass('hidden');
		}
	};
	
	
	$('.input_capital').on('input', function(evt) {
		$(this).val(function (_, val) {
			return val.toUpperCase();
		});
	});
	
	
	$('#are_id').change(function(event){
		cargarClasificacionDirecccion(null);		
	});	

});

function cargarClasificacionDirecccion(cdi_id){
	var are_id_p = $('#are_id').val();
	console.log( are_id_p );		  

	$.post("obtenerClasificacionDireccion.php",{ are_id : are_id_p, cdi_id:cdi_id }, function( response ) {
		response = $.trim(response);
		//console.log(response);
		$("#cdi_id").html(response);
	});
}

