$(document).ready(function () { 
	console.log('registro ok');
	window.Parsley.setLocale('es');
	$(function () {
	    $('#datepicker_fn').datepicker({
	    	format: 'dd-mm-yyyy',
	  		language: 'es',
	  		todayHighlight: true
	    });
	    
	    $('#datepicker_ff').datepicker({
	    	format: 'dd-mm-yyyy',
	  		language: 'es',
	  		todayHighlight: true
	    });

	    $('#datepicker_fc').datepicker({
	    	format: 'dd-mm-yyyy',
	  		language: 'es',
	  		todayHighlight: true
	    });

	});
	
	$("#btn_guardar").click(function(e){
		e.preventDefault();		
		$("#div_success").hide();
		$("#div_error").hide();
		$("#div_loading").show();
		$('#formulario').parsley().validate();		
			
		var rta = false;
		if($("#pob_str_adjunto").val() === ""){			
			$("#div_loading").hide();
			
			if($( "#error_adjunto" )){
				$('#pob_str_adjunto').removeClass("bs-callout bs-callout-danger");
				$("#pob_str_adjunto").parent().removeClass("bs-callout bs-callout-danger");
				$( "#error_adjunto" ).remove();
			}
			
			$("#pob_str_adjunto").after( "<span id='error_adjunto' class='text-danger'>Debe seleccionar un archivo</span>" );
			$('#pob_str_adjunto').addClass("bs-callout bs-callout-danger");
			$("#pob_str_adjunto").parent().addClass("bs-callout bs-callout-danger");
			return false;
		}else{
			rta = validar_adjunto();
		}	
		//console.log("rta:" + rta );
		if (true === $('#formulario').parsley().isValid() && rta===true) {
			var data = new FormData();			
			data = $("#formulario").serialize();
			$.ajax({
				url: 'registro_guardar.php',
				type: 'POST',
				data: data,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					var return_data = $.trim(response);
					$("#div_loading").hide();
					if(response=="OK"){
						$("#div_success").show();
						$("#div_formulario").hide();
					}else{
						$("#div_error").show();
						$("#mensaje_error").html(response);
					}		
					
				},
				error: function(){
					alert("error in ajax form submission");
				}
			});
			/*
			
			$.post("registro_guardar.php",$("#formulario").serialize(),null)
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
			*/
		}else{
			$("#div_loading").hide();
		}
	});
	
	/*
	$.listen('parsley:field:validate', function () {
		validateFront();
	});
	*/
  

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
	
	$('#pob_str_adjunto').bind('change', validar_adjunto);
	
});

function validar_adjunto() {
	var limite = {size:'2097152', type:'application/pdf'};
	var msg = "";	
	if($("#pob_str_adjunto")[0].files[0].size > limite.size || $("#pob_str_adjunto")[0].files[0].fileSize > limite.size ){
		msg= msg + "<br/>El tamaño del archivo adjunto sobrepasa el permitido.";			
	}
	if($("#pob_str_adjunto")[0].files[0].type > limite.type){
		msg= msg + "<br/>El tipo del archivo adjunto no es permitido.";			
	}
	if(msg !== ""){
		$( "#error_adjunto" ).remove();
		$("#pob_str_adjunto").after( "<span id='error_adjunto' class='text-danger'>"+msg+"</span>" );
		$('#pob_str_adjunto').addClass("bs-callout bs-callout-danger");
		$("#pob_str_adjunto").parent().addClass("bs-callout bs-callout-danger");
		return false;
	}else{
		$('#pob_str_adjunto').removeClass("bs-callout bs-callout-danger");
		$("#pob_str_adjunto").parent().removeClass("bs-callout bs-callout-danger");
		$( "#error_adjunto" ).remove();
		return true;
	}
	
}