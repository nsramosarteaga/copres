<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
<?=$lang['registro']['titulo_2']?>
	  <small><?=$lang['nombre_corto_proyecto']?></small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="#"><?=$lang['mnu_registro']['titulo']?></a></li>
	  <li class="active"><?=$lang['mnu_registro']['item_2']?></li>
	</ol>
</section>


<!-- Main content -->
<section class="content">
	
	<div id="pre-load-web">
		<div id="imagen-load"><img src="<?=$config['url_aplicacion'];?>img/pre_load_495.gif" alt="" />Cargando...</div>
	</div>
	
	<div class="row" id="div_formulario">
	    <div class="col-md-12">


	    	<!-- general form elements -->
		  	<div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title"><?=$lang['reporte']['subtitulo']?></h3>
				</div><!-- /.box-header -->
				
				<!-- form start -->
				<form role="form" id="formulario" data-parsley-validate="">
					
				  	<div class="box-body">
					
						<div class="row">
		    				<div class="col-md-6">
								<div class="form-group">
									<label><?=$lang['frm_registro']['tipo_documento']?></label>
									<select class="form-control" name="tdo_id" id="tdo_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
										<?php
										foreach ($array_tdo as $row) {
											echo '<option value="'.$row['tdo_id'].'">'.$row['tdo_str_referencia'].' - '.$row['tdo_str_descripcion'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?=$lang['frm_registro']['num_documento']?></label>
									<input type="text" class="form-control" data-parsley-type="digits" data-parsley-length="[4, 32]" placeholder="Solo números" id="pob_str_documento" name="pob_str_documento" >
								</div>
							</div>
						</div>

						<div class="row">
		    				<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['ape_1']?></label>
									<input type="text" class="form-control input_capital" data-parsley-length="[3, 32]" id="pob_str_apellido1" name="pob_str_apellido1" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['ape_2']?></label>
									<input type="text" class="form-control input_capital" data-parsley-length="[3, 32]" id="pob_str_apellido2" name="pob_str_apellido2" value="">
								</div>
							</div>
						
		    				<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['nom_1']?></label>
									<input type="text" class="form-control input_capital"  data-parsley-length="[3, 32]" id="pob_str_nombre1" name="pob_str_nombre1" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['nom_2']?></label>
									<input type="text" class="form-control input_capital" data-parsley-length="[3, 32]" id="pob_str_nombre2" name="pob_str_nombre2" value="">
								</div>
							</div>
						</div>
					
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" id="btn_buscar_criterios"><?=$lang['sistema']['btn_buscar']?></button>
						
						<!--
						<button type="button" class="btn btn-info" id="btn_expotar_pdf_df" style = "display:none;">
						  <span class="glyphicon glyphicon-floppy-save"></span> <?=$lang['sistema']['btn_pdf']?>
						</button>
						-->
					</div>
				</form>
				<!-- form end -->
				
			</div>
			
			
		</div>
	</div>
	
	<div id="div_listado"></div>
	
	<!-- Modal -->
	<div class="modal fade" id="modalMostrarRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<input type="hidden" id="pob_id" name="pob_id" value="">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><?=$lang['mdl_mostrar_datos']['titulo']?></h4>
		  </div>
		  <div class="modal-body" id="modalBody">			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?=$lang['sistema']['btn_cerrar']?></button>
			<button type="button" class="btn btn-primary" id="btn_certificacion"><?=$lang['sistema']['btn_certificacion']?></button>
		  </div>
		</div>
	  </div>
	</div>
	
</section>
