var asInitVals = new Array();


$(document).ready(function () { 
	var oTableG = null;
	var url_aplicacion = '../Spanish.json';
	$("#pre-load-web").hide();

	console.log('reporte ok');
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
	
	$("#btn_buscar").click(function(e){
		e.preventDefault();		
		var filtro = "";
		$("#pre-load-web").show();
		
		$('#formulario').parsley().validate();		
			
		
		if (true === $('#formulario').parsley().isValid() ) {
			console.log("min:" + $("#pob_num_edad_min").val());
			console.log("max:" + $("#pob_num_edad_max").val());
			if($("#pob_num_edad_min").val()>$("#pob_num_edad_max").val()){
				alert('La edad mínima, debe ser inferior a la edad máxima');
				$("#pre-load-web").hide();
				return false;
			}
			if($("#pob_num_edad_min").val()==="" && $("#pob_num_edad_max").val()!==""){
				alert('La edad mínima, no puede estar vacía');
				$("#pre-load-web").hide();
				return false;
			}
			
			if($("#tdo_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = 'Tipo Doc:'+$("#tdo_id").children("option").filter(":selected").text();
			if($("#pob_str_documento").val()!=='') filtro = filtro + ' Num. Doc:'+$("#pob_str_documento").val();
			if($("#sex_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Genero:' + $("#sex_id").children("option").filter(":selected").text(); 
			if($("#are_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Area:' + $("#are_id").children("option").filter(":selected").text(); 
			if($("#cdi_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Barrio/Vereda:' + $("#cdi_id").children("option").filter(":selected").text(); 
			if($("#eps_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' EPS:' + $("#eps_id").children("option").filter(":selected").text(); 
			if($("#pob_str_serialFormulario").val()!=='') filtro = filtro + ' Serial:'+$("#pob_str_serialFormulario").val();
			if($("#cpo_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Población:' + $("#cpo_id").children("option").filter(":selected").text(); 
			if($("#niv_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Nivel:' + $("#niv_id").children("option").filter(":selected").text(); 
			if($("#tno_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Novedad:' + $("#tno_id").children("option").filter(":selected").text(); 
			if($("#est_id").children("option").filter(":selected").text() !== 'Seleccione') filtro = filtro + ' Estado:' + $("#est_id").children("option").filter(":selected").text();
			if($("#pob_num_edad_min").val() !== "" && $("#pob_num_edad_max").val() !== "")  filtro = filtro + ' Edad:' + $("#pob_num_edad_min").val() + " a " + $("#pob_num_edad_max").val();
			
			$("#filtro").val(filtro);
			console.log( $("#filtro").val() );
			
			$.post("reporteBuscar.php",$("#formulario").serialize(),null)
			.done(function( response, textStatus, jqXHR ) {
				response = $.trim(response);
				console.log("rta:"+response+'\nurl:'+url_aplicacion);				
				$("#div_listado").html(response);
				$("#resultados_busqueda").DataTable({
					searching: false,
					"language": { "url": url_aplicacion },
					"pageLength": 25
				});
				$("#btn_expotar_pdf_rpt").show("slow");
				$("#btn_expotar_csv_rpt").show("slow");
				var asInitVals = new Array();
				oTableG = $('#resultados_busqueda').dataTable();				
				$("#pre-load-web").hide();
			});
			
		}else{
			$("#pre-load-web").hide();
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
		var are_id_p = $('#are_id').val();
		console.log( are_id_p );
		$.post("../registro/obtenerClasificacionDireccion.php",{ are_id : are_id_p }, function( response ) {
			response = $.trim(response);
			console.log(response);
			$("#cdi_id").html(response);
		});
	});	
	
	
	$("#btn_expotar_pdf_rpt").on('click',function(){
		$("#pre-load-web").show();
		$.post("reporteBuscar.php",$("#formulario").serialize(),null)
		.done(function( response, textStatus, jqXHR ) {
			response = $.trim(response);
			console.log("rta php: "+response);
			var filename='../files/pdf/reporte_copres_'+obtenerFecha()+'.pdf';
			$.post('../../controllers/generar_html2pdf.php', { contenido:response , filename:filename, pageorientation:'P' }, null)
			.done(function( data, textStatus, jqXHR ) {
			    console.log("rta pdf: "+data);
				window.open("../"+filename);
				$("#pre-load-web").hide();
			});
		});	
	});
	
	
	$("#btn_expotar_csv_rpt").on('click',function(event) {
        console.log("generar csv");
        event.preventDefault();
		//table2csv(oTableG, 'full', 'table.display');
		CSVExportDataTable(oTableG,'Full'); 
	});

});



function obtenerFecha(){
	var d = new Date();
	var n = d.toString();
	var today = new Date().toISOString().slice(0, 19);
	today = today.split("T",2);
	// fecha
	fecha = today[0].split("-",3);
	today[1] = d.toTimeString();
	hora = today[1].slice(0,8);
	hora = hora.split(":",3);

	var stringDate='';
	fecha.forEach(function(entry) {
		stringDate += entry;
	});

	hora.forEach(function(entry){
		stringDate += entry;
	});
	return stringDate;
}



// CSV Export Function
function CSVExportDataTable(oTable, exportMode)
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
 
