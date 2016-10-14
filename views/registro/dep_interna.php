<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
<?=$lang['registro']['titulo_5']?>
	  <small><?=$lang['nombre_corto_proyecto']?></small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="#"><?=$lang['mnu_reporte']['titulo']?></a></li>
	  <li class="active"><?=$lang['mnu_reporte']['item_1']?></li>
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
				  <h3 class="box-title"><?=$lang['registro']['subtitulo_5']?></h3>
				</div><!-- /.box-header -->
				
				<!-- form start -->
				<form role="form" id="formulario" data-parsley-validate="">
				
				  	<div class="box-body">
					
						<div class="row">
		    				<div class="col-md-3">
								<div class="form-group">								
									<select class="form-control" name="criterio_sel" id="criterio_sel" onchange = "cargarDesc();">
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php

$criterios_internos = array("Criterio 1" => "Apellido 1, Apellido 2, Nombre 1, Nombre 2 y Fecha de Nacimiento", "Criterio 2" => "Apellido 1, Nombre 1 y Fecha de Nacimiento", "Criterio 3" => "Apellido 2, Nombre 2 y Fecha de Nacimiento", "Criterio 4" => "Apellido 1, Apellido 2, Nombre 1, Nombre 2", "Criterio 5" => "Apellido 1, Nombre 2 y Fecha de Nacimiento", "Criterio 6" => "Apellido 2, Nombre 1 y Fecha de Nacimiento", "Criterio 7" => "Número de Documento");

foreach ($criterios_internos as $llave => $valor){
	echo '<option value="'.$llave.'">'.$llave.'</option>';
}
?>
									</select>
								</div>
							</div>
							<div class="col-md-5" valign = 'middle'>							
								<div id = "desc_criterios" class="form-group">							
								</div>
							</div>
						</div>
						
						<div  class="row">
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary" id="btn_aplicar_criterio"><?=$lang['sistema']['btn_aplicar_criterio']?></button>
							</div>
						</div>
											
					</div><!-- /.box-body -->

					
				</form>
				<!-- form end -->
				
			</div>
			
			
		</div>
	</div>
	
	<div id="div_listado"></div>
	
	<!-- Modal Mostrar Registro -->
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
			<!-- <button type="button" class="btn btn-primary" id="btn_certificacion"><?=$lang['sistema']['btn_certificacion']?></button> -->
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Modal Editar Población -->
	<div class="modal fade" id="modalEditarPoblacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		
		<!-- form start -->
		<form role="form" id="formulario_modal" data-parsley-validate="">
		
		  <div class="modal-header">
			
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><?=$lang['mdl_editar_poblacion']['titulo']?></h4>
		  </div>
		  
		  <div class="modal-body">
			
			<div class="row" id="div_formulario">
				<div class="col-md-12">


					<!-- general form elements -->
					<div class="box box-success">
						<div class="box-header with-border"></div><!-- /.box-header -->

						
							<input type="hidden" id="pob_id_modal" name="pob_id_modal" value="">
							<div class="box-body">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['tipo_documento']?></label>
											<select class="form-control" name="tdo_id" id="tdo_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_tdo as $row) {
			echo '<option value="'.$row['tdo_id'].'" ';
			if($poblacion['tdo_id'] == $row['tdo_id']) echo "selected";
			echo ' >'.$row['tdo_str_referencia'].' - '.$row['tdo_str_descripcion'].'</option>';
		}
		?>
											</select>									
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['num_documento']?></label>
											<input type="text" class="form-control" required="" data-parsley-type="digits" data-parsley-length="[4, 32]" placeholder="Solo números" id="pob_str_documento" name="pob_str_documento" value="<?=$poblacion['pob_str_documento']?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['ape_1']?></label>
											<input type="text" class="form-control input_capital" required="" data-parsley-length="[3, 32]" id="pob_str_apellido1" name="pob_str_apellido1" value="<?=$poblacion['pob_str_apellido1']?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['ape_2']?></label>
											<input type="text" class="form-control input_capital" data-parsley-length="[3, 32]" id="pob_str_apellido2" name="pob_str_apellido2" value="<?=$poblacion['pob_str_apellido2']?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['nom_1']?></label>
											<input type="text" class="form-control input_capital" required="" data-parsley-length="[3, 32]" id="pob_str_nombre1" name="pob_str_nombre1" value="<?=$poblacion['pob_str_nombre1']?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['nom_2']?></label>
											<input type="text" class="form-control input_capital" data-parsley-length="[3, 32]" id="pob_str_nombre2" name="pob_str_nombre2" value="<?=$poblacion['pob_str_nombre2']?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['genero']?></label>
											<select class="form-control" name="sex_id" id="sex_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_genero as $row) {
			echo '<option value="'.$row['sex_id'].'" ';
			if($poblacion['sex_id'] == $row['sex_id']) echo "selected";
			echo  " >".$row['sex_str_referencia'].' - '.$row['sex_str_descripcion'].'</option>';
		}
		?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['fec_nacimiento']?></label>
											<div class='input-group date' id='datepicker_fn'>
												<input type='text' class="form-control" name="pob_dat_fechaNacimiento" id="pob_dat_fechaNacimiento" placeholder="dd/mm/aaaa" required="" value="<?=$poblacion['pob_dat_fechaNacimiento']?>" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											 </div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label><?=$lang['frm_registro']['area']?></label>
											<select class="form-control" name="are_id" id="are_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_area as $row) {
			echo '<option value="'.$row['are_id'].'" ';
			if($poblacion['are_id'] == $row['are_id']) echo "selected";
			echo  " >".$row['are_str_referencia'].' - '.$row['are_str_descripcion'].'</option>';
		}
		?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
										<label><?=$lang['frm_registro']['cdireccion']?></label>											
											<select class="form-control" name="cdi_id" id="cdi_id" required="">
											</select>											
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label><?=$lang['frm_registro']['direccion']?></label>
											<input type="text" class="form-control input_capital" required="" data-parsley-length="[10,255]" id="pob_str_direccion" name="pob_str_direccion" value="<?=$poblacion['pob_str_direccion']?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['telefono']?></label>
											<input type="text" class="form-control input_capital" data-parsley-length="[7, 16]" id="pob_str_telefono" name="pob_str_telefono" value="<?=$poblacion['pob_str_telefono']?>">
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label><?=$lang['frm_registro']['correo']?></label>
											<input type="email" class="form-control input_capital" id="pob_str_correo" name="pob_str_correo" value="<?=$poblacion['pob_str_correo']?>">
										</div>
									</div>
								</div>



								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['eps']?></label>
											<select class="form-control" name="eps_id" id="eps_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_eps as $row) {
			echo '<option value="'.$row['eps_id'].'" ';
			if($poblacion['eps_id'] == $row['eps_id']) echo "selected";
			echo  " >".$row['eps_str_nombre'].' ['.$row['eps_str_codigo'].']</option>';
		}
		?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['serial']?></label>
											<input type="text" class="form-control input_capital" required="" data-parsley-length="[1, 64]" data-parsley-type="alphanum" id="pob_str_serialFormulario" name="pob_str_serialFormulario" value="<?=$poblacion['pob_str_serialFormulario']?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['fec_formulario']?></label>
											<div class='input-group date' id='datepicker_ff'>
												<input type='text' class="form-control" name="pob_dat_fechaFormulario" id="pob_dat_fechaFormulario" placeholder="dd/mm/aaaa" required="" value="<?=$poblacion['pob_dat_fechaFormulario']?>"/>
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											 </div>
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['poblacion']?></label>
											<select class="form-control" name="cpo_id" id="cpo_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_cpoblacion as $row) {
			echo '<option value="'.$row['cpo_id'].'" ';
			if($poblacion['cpo_id'] == $row['cpo_id']) echo "selected";
			echo  " >".$row['cpo_num_codigo'].' - '.$row['cpo_str_descripcion'].'</option>';
		}
		?>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['nivel']?></label>
											<select class="form-control" name="niv_id" id="niv_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_nivel as $row) {
			echo '<option value="'.$row['niv_id'].'" ';
			if($poblacion['niv_id'] == $row['niv_id']) echo "selected";
			echo  " >".$row['niv_str_referencia'].'</option>';
		}
		?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['puntaje']?></label>
											<input type="text" class="form-control" required="" data-parsley-type="number" data-parsley-max="100" id="pob_num_puntaje" name="pob_num_puntaje" placeholder="Ejemplo: 80.50" value="<?=$poblacion['pob_num_puntaje']?>" >
										</div>
									</div>

								</div>

								<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['tipo_novedad']?></label>
											<select class="form-control" name="tno_id" id="tno_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_tno as $row) {
			echo '<option value="'.$row['tno_id'].'" ';
			if($poblacion['tno_id'] == $row['tno_id']) echo "selected";
			echo  " >".$row['tno_str_descripcion'].' ['.$row['tno_str_referencia'].']</option>';
		}
		?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label><?=$lang['frm_registro']['estado']?></label>
											<select class="form-control" name="est_id" id="est_id" required="">
												<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
		<?php
		foreach ($array_estado as $row) {
			echo '<option value="'.$row['est_id'].'" ';
			if($poblacion['est_id'] == $row['est_id']) echo "selected";
			echo  " >".$row['est_str_referencia'].' - '.$row['est_str_descripcion'].'</option>';
		}
		?>
											</select>
										</div>
									</div>

								</div>

								<div class="form-group">
									<label><?=$lang['frm_registro']['observacion']?></label>
									<textarea class="form-control" rows="3" placeholder="::..." id="pob_str_observacion" name="pob_str_observacion" ></textarea>
								</div>

								
							</div><!-- /.box-body -->
						

					</div><!-- /.box -->
				</div>
			</div>   <!-- /.row -->
			
		  </div>
		  
		  <div class="modal-footer">
		  <button type="button" class="btn btn-primary" id="btn_modificar_modal"><?=$lang['sistema']['btn_modificar']?></button>
			<button type="button" class="btn btn-warning" data-dismiss="modal"><?=$lang['sistema']['btn_cerrar']?></button>
			<!--<button type="button" class="btn btn-primary" id="btn_certificacion"><?=$lang['sistema']['btn_certificacion']?></button>-->
		  </div>
		  
		</form>
		<!-- form end -->
		</div>
	  </div>
	</div>
	
</section>
