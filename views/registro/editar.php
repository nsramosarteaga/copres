<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
<?=$lang['registro']['titulo_4']?>
	  <small><?=$lang['nombre_corto_proyecto']?></small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="#"><?=$lang['mnu_registro']['titulo']?></a></li>
	  <li class="active"><?=$lang['mnu_registro']['item_4']?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- DIV de carga -->
	<div class="row" id="div_loading">
		<div class="col-md-4 col-md-push-4">
			<div class="box box-warning box-solid">
				<div class="box-header">
				    <h3 class="box-title"><?=$lang['sistema']['actualizando']?></h3>
				</div>
				<div class="box-body"><?=$lang['frm_registro']['actualizando']?></div><!-- /.box-body -->
				<!-- Loading (remove the following to stop the loading)-->
				<div class="overlay">
				  <i class="fa fa-refresh fa-spin"></i>
				</div>
				<!-- end loading -->
			</div><!-- /.box -->
		</div>
	</div>

	<!-- DIV de exitó -->
	<div class="row" id="div_success">
		<div class="col-md-4 col-md-push-4">
			<div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$lang['sistema']['actualizado']?></h3>
                </div><!-- /.box-header -->
                <div class="box-body"><?=$lang['sistema']['actualizado_existoso']?></div><!-- /.box-body -->
				<div class="box-footer">
					<!-- <button class="btn btn-success btn-sm pull-right"><?=$lang['sistema']['btn_continuar']?></button> -->
					<a href="<?=$config['url_aplicacion'].'controllers/registro/buscarCriterios.php'?>" class="btn btn-success btn-sm pull-right" role="button"><?=$lang['sistema']['btn_continuar']?></a>
				</div>
            </div>
		</div>
	</div>

	<!-- DIV de error -->
	<div class="row" id="div_error">
		<div class="col-md-4 col-md-push-4">
			<div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$lang['sistema']['error']?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" id="mensaje_error">
                </div><!-- /.box-body -->
            </div>
		</div>
	</div>

	<div class="row" id="div_formulario">
	    <div class="col-md-8 col-md-push-2">


	    	<!-- general form elements -->
		  	<div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title"><?=$lang['registro']['subtitulo']?></h3>
				</div><!-- /.box-header -->

				<!-- form start -->
				<form role="form" id="formulario" data-parsley-validate="">
					<input type="hidden" id="pob_id" name="pob_id" value="<?=$pob_id?>">
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
										<option value="<?=$poblacion['cdi_id']?>" ><?=$poblacion['cdi_str_nombre']?></option> 
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
                      		<textarea class="form-control" rows="3" placeholder="::..." id="pob_str_observacion" name="pob_str_observacion" ></textarea><!--<?=$poblacion['pob_str_observacion']?>-->
                    	</div>

						
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" id="btn_modificar"><?=$lang['sistema']['btn_modificar']?></button>
						<a href="<?=$config['url_aplicacion'].'controllers/registro/buscarCriterios.php'?>" class="btn btn-warning" role="button"><?=$lang['sistema']['btn_atras']?></a>
					</div>
				</form>
				<!-- form end -->

			</div><!-- /.box -->
	    </div>
	</div>   <!-- /.row -->



</section><!-- /.content -->
