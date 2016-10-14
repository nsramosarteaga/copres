var poblacion_id_activo = null;
$(document).ready(function () {
	console.log('registro ok');
	
	var url_aplicacion = '../Spanish.json';
	$("#pre-load-web").hide();
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
	
	$("#btn_guardar").click(function(e){
		e.preventDefault();		
		$("#div_success").hide();
		$("#div_error").hide();
		$("#div_loading").show();
		$('#formulario').parsley().validate();			
			
		
		if (true === $('#formulario').parsley().isValid() ) {			
			$.post("registroGuardar.php",$("#formulario").serialize(),null)
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
	
	//$('#pob_str_adjunto').bind('change', validar_adjunto);

	$('#are_id').change(function(event){		
		var are_id_p = $('#are_id').val();
		console.log( are_id_p );
		obtenerClasificacionDireccion(are_id_p);
	});
	
	var url_aplicacion = '../Spanish.json';
	
	console.log('url:' + url_aplicacion);
	$("#registroBuscarDatatable").dataTable({
		"language": { "url": url_aplicacion },
		"pageLength": 25
	});
	
	
	$("#btn_buscar_criterios").click(function(e){
		e.preventDefault();
		poblacion_id_activo = null;
		$("#pre-load-web").show();		
		$('#formulario').parsley().validate();		
		if (true === $('#formulario').parsley().isValid() ) {			
			console.log($("#formulario").serialize());			
			$.post("buscarCriteriosRespuesta.php",$("#formulario").serialize(),null)
			.done(function( response, textStatus, jqXHR ) {
				response = $.trim(response);
				console.log("rta:"+response+'\nurl:'+url_aplicacion);				
				$("#div_listado").html(response);
				$("#resultados_busqueda").DataTable({
					searching: false,
					"language": { "url": url_aplicacion },
					"pageLength": 25
				});
				$("#pre-load-web").hide();
			});
			
		}else{
			$("#pre-load-web").hide();
		}		
	});
	
	$("#btn_certificacion").click(function(e){
		console.log('generar certificación');
		var pob_id = $("#pob_id").val();
		$.post("registroCertificado.php",{pob_id:pob_id},null)
		.done(function( response, textStatus, jqXHR ) {
			response = $.trim(response);
		    console.log(response);
			var filename='../files/pdf/certificado_'+obtenerFecha()+'.pdf';			
			$.post('../../controllers/generarCertificadoPDF.php', { contenido:response , filename:filename, pageorientation:'P' }, null)
			.done(function( data, textStatus, jqXHR ) {
				console.log("rta pdf: "+data);
				window.open("../"+filename);
				$("#pre-load-web").hide();
			});
		});
	});
	
	
	$("#btn_aplicar_criterio").click(function(e){
		e.preventDefault();		
		$("#pre-load-web").show();		
		$('#formulario').parsley().validate();		
		if (true === $('#formulario').parsley().isValid() ) {			
			//console.log($("#formulario").serialize());			
			$.post("dep_internaRespuesta.php",$("#formulario").serialize(),null)
			.done(function( response, textStatus, jqXHR ) {
				response = $.trim(response);
				//console.log("rta:"+response+'\nurl:'+url_aplicacion);				
				$("#div_listado").html(response);
				$("#resultados_busqueda").DataTable({
					searching: false,
					"language": { "url": url_aplicacion },
					"pageLength": 25
				});
				$("#pre-load-web").hide();
			});
			
		}else{
			$("#pre-load-web").hide();
		}		
	});
	

	$("#btn_modificar_modal").click(function(e){
		console.log('actualizar datos');
		$('#formulario_modal').parsley().validate();		
		if (true === $('#formulario_modal').parsley().isValid() ) {	
		
			$.post("registroEditar.php",$("#formulario_modal").serialize(), function( response ) {
				response = $.trim(response);				
				console.log('rta:' + response);			
				if(response==="OK"){
					alert('El registro se actualizo exitosamente');
				}else{
					alert('El registro no se pudó actualizar');
				}
				$("#modalEditarPoblacion").modal('hide');
			});
		}
	});
	
	$("#btn_export_coincidencias").on('click',function(event) {
		window.open('../../files/csv/coincidencias_totales.csv');
	});
	
	$("#btn_export_coincidencias_parciales").on('click',function(event) {
		window.open('../../files/csv/coincidencias_parciales.csv');
	});
	
	$("#btn_export_no_copre").on('click',function(event) {
		window.open('../../files/csv/no_copres.csv');
	});
	
	$("#btn_export_no_epss").on('click',function(event) {
		window.open('../../files/csv/no_eps.csv');
	});
	
	
});

function obtenerClasificacionDireccion(are_id_p){
	console.log('area_id:'+are_id_p);
	$.post("obtenerClasificacionDireccion.php",{ are_id : are_id_p }, function( response ) {
		response = $.trim(response);
		$("#cdi_id").html(response);
	});
}
/*
function obtenerClasificacionDireccionModal(are_id_p,cdi_id_p){
	console.log('area_id:'+are_id_p);
	$.post("obtenerClasificacionDireccion.php",{ are_id : are_id_p }, function( response ) {
		response = $.trim(response);
		//console.log(response);
		$("#cdi_id").html(response);
		$('#cdi_id option:eq('+cdi_id_p+')').prop('selected', true);	
	});
}
*/
function validar_adjunto() {
	var limite = {size:'2097152', type:'application/csv'};
	var msg = "";	
	if($("#pob_str_adjunto")[0].files[0].size > limite.size || $("#pob_str_adjunto")[0].files[0].fileSize > limite.size ){
		msg= msg + "<br/>El tamaño del archivo adjunto sobrepasa el permitido.";			
	}
	if($("#pob_str_adjunto")[0].files[0].type == limite.type){
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

function modificarRegistro(pob_id){
	$('#form_editar_'+pob_id).submit();
}

function eliminarRegistro(pob_id){
	var r = confirm("¿Esta seguro de eliminar el registro?");
	if (r == true) {
		//alert('eliminar ID ' + pob_id);
		$.post("registroEliminar.php",{ pob_id : pob_id }, function( response ) {
			response = $.trim(response);
			if(response==="OK"){				
				alert("El registro se ha eliminado exitosamente.");
				$(location).attr('href','buscarCriterios.php');				
			}else{
				alert(response);				
			}
		});
	} else {
		return false;
	}
}

function mostrarRegistro(pob_id){
	console.log('pob_id:'+pob_id);
	$("#pob_id").val(pob_id);
	poblacion_id_activo = pob_id;
	$.post("registroMostrar.php",{ pob_id : pob_id }, function( response ) {
		response = $.trim(response);
		//console.log(response);
		$("#modalBody").html(response);
	});
		
	$("#modalMostrarRegistro").modal('show');
}

function cargarDesc()
{
	$("#desc_criterios").html(criterios[document.getElementById("criterio_sel").value]);
}

function modificarRegistroModal(pob_id){
	console.log('pob_id:'+pob_id);		
	$.ajaxSetup({async: false});
	$.ajax(
	{
		type: "POST",
		url: 'editarModal.php',
		data:
		{
			'pob_id': pob_id
		},
		success: function(data)
		{
			//console.log('region:'+data);
			if(JSON.parse(data)[0]['status'] == "OK")
			{
				console.log(JSON.parse(data)[1]);
				
				$("#pob_id_modal").val(pob_id);
				
				$("#pob_str_documento").val(JSON.parse(data)[1]['pob_str_documento']);
				$("#pob_str_apellido1").val(JSON.parse(data)[1]['pob_str_apellido1']);
				$("#pob_str_apellido2").val(JSON.parse(data)[1]['pob_str_apellido2']);
				$("#pob_str_nombre1").val(JSON.parse(data)[1]['pob_str_nombre1']);
				$("#pob_str_nombre2").val(JSON.parse(data)[1]['pob_str_nombre2']);
				
				$("#pob_dat_fechaNacimiento").val(JSON.parse(data)[1]['pob_dat_fechaNacimiento']);
				$("#pob_str_direccion").val(JSON.parse(data)[1]['pob_str_direccion']);
				$("#pob_str_telefono").val(JSON.parse(data)[1]['pob_str_telefono']);
				$("#pob_str_correo").val(JSON.parse(data)[1]['pob_str_correo']);
				$("#pob_str_serialFormulario").val(JSON.parse(data)[1]['pob_str_serialFormulario']);
				$("#pob_dat_fechaFormulario").val(JSON.parse(data)[1]['pob_dat_fechaFormulario']);
				$("#pob_num_puntaje").val(JSON.parse(data)[1]['pob_num_puntaje']);
				$("#pob_str_observacion").val('');
				
				
				//var $select = $("select[name='tdo_id']");
				//$select.find('option').remove();
				$('#tdo_id option:eq('+JSON.parse(data)[1]['tdo_id']+')').prop('selected', true);
				$('#sex_id option:eq('+JSON.parse(data)[1]['sex_id']+')').prop('selected', true);
				$('#are_id option:eq('+JSON.parse(data)[1]['are_id']+')').prop('selected', true);
				
				if( JSON.parse(data)[1]['are_id'] !== null){
					var are_id_p = JSON.parse(data)[1]['are_id'];
					var cdi_id_p = JSON.parse(data)[1]['cdi_id'];
					console.log('are_id:' +  are_id_p + ' | cdi_id:' +cdi_id_p );
						
					$.post("obtenerClasificacionDireccion.php",{ are_id : are_id_p, cdi_id:cdi_id_p}, function( response ) {
						response = $.trim(response);
						//console.log(response);
						$("#cdi_id").html(response);
						//$('#cdi_id option:eq(' + JSON.parse(data)[1]['cdi_id'] + ')').prop('selected', true);
					});
				}else{
					console.log('NO obtener');				}
				
				
				$('#eps_id option:eq('+JSON.parse(data)[1]['eps_id']+')').prop('selected', true);
				$('#cpo_id option:eq('+JSON.parse(data)[1]['cpo_id']+')').prop('selected', true);
				$('#niv_id option:eq('+JSON.parse(data)[1]['niv_id']+')').prop('selected', true);
				$('#tno_id option:eq('+JSON.parse(data)[1]['tno_id']+')').prop('selected', true);
				$('#est_id option:eq('+JSON.parse(data)[1]['est_id']+')').prop('selected', true);
			}else{
				console.log(JSON.parse(data)[0]['response']);
			}
		}
	});
	$.ajaxSetup({async: true});
	$("#modalEditarPoblacion").modal('show');	
}


// CSV Export Function
function CSVExportTable(oTable, exportMode)
{   
	// Init
	var csv = '';
	var headers = [];
	var rows = [];
	var dataSeparator = '|~|';

	// Get table header names
	$(oTable).find('thead th').each(function() {
		var text = $(this).text();
		if(text != "") headers.push(text);
	});
	csv += headers.join(dataSeparator) + "\r\n";

		// Get table body data
		if (exportMode == 'Full') {
			var totalRows = oTable.fnSettings().fnRecordsTotal();
			for (var i = 0; i < totalRows; i++) {
				var row = oTable.fnGetData(i);
				rows.push(row.join(dataSeparator));
			}
		} else {
			$(oTable._('tr:visible', { })).each(function(index, row) {
				rows.push(row.join(dataSeparator));
			});
		}
		csv += rows.join("\r\n");

	// Proceed if csv data was loaded
	if (csv.length > 0)
	{
		// Ajax Post CSV Data
		$.ajax({
			type: "POST",
			url: 'dt_csv_export.php',
			data: {
				action: "generate",
				csv_type: oTable.attr('id'),
				csv_data: csv
			},
			success: function(download_link) {
				console.log('link:' + download_link);
				//location.href = download_link;				
				window.open(download_link);
			}
		});
	}
}
