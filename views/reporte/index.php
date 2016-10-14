<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
<?=$lang['reporte']['titulo']?>
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
				  <h3 class="box-title"><?=$lang['reporte']['subtitulo']?></h3>
				</div><!-- /.box-header -->
				
				<!-- form start -->
				<form role="form" id="formulario" data-parsley-validate="">
					<input type="hidden" id="filtro" name="filtro" value="">
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
									<input type="text" class="form-control" data-parsley-type="digits" data-parsley-length="[4, 32]" placeholder="Solo números" id="pob_str_documento" name="pob_str_documento">
								</div>
							</div>
						</div>
						
						<div class="row">
		    				<div class="col-md-2">
								<div class="form-group">
									<label><?=$lang['frm_registro']['genero']?></label>
									<select class="form-control" name="sex_id" id="sex_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_genero as $row) {
	echo '<option value="'.$row['sex_id'].'">'.$row['sex_str_referencia'].' - '.$row['sex_str_descripcion'].'</option>';
}
?>
									</select>
								</div>
							</div>
							
							<div class="col-md-2">
								<div class="form-group">
									<label><?=$lang['frm_registro']['area']?></label>
									<select class="form-control" name="are_id" id="are_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_area as $row) {
	echo '<option value="'.$row['are_id'].'">'.$row['are_str_referencia'].' - '.$row['are_str_descripcion'].'</option>';
}
?>
									</select>
								</div>
							</div>
							
							<div class="col-md-2">
								<div class="form-group">
								<label><?=$lang['frm_registro']['cdireccion']?></label>
									<select class="form-control" name="cdi_id" id="cdi_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
										<?php
// foreach ($array_cdireccion as $row) {
	// echo '<option value="'.$row['cdi_id'].'">'.$row['cdi_str_tipo'].'. '.$row['cdi_str_nombre'].'</option>';
// }
?>
									</select>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['eps']?></label>
									<select class="form-control" name="eps_id" id="eps_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_eps as $row) {
	echo '<option value="'.$row['eps_id'].'">'.$row['eps_str_nombre'].' ['.$row['eps_str_codigo'].']</option>';
}
?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['serial']?></label>
									<input type="text" class="form-control input_capital" data-parsley-length="[1, 64]" data-parsley-type="alphanum" id="pob_str_serialFormulario" name="pob_str_serialFormulario" >
								</div>
							</div>
							
						</div>
						
						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['poblacion']?></label>
									<select class="form-control" name="cpo_id" id="cpo_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_cpoblacion as $row) {
	echo '<option value="'.$row['cpo_id'].'">'.$row['cpo_num_codigo'].' - '.$row['cpo_str_descripcion'].'</option>';
}
?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['nivel']?></label>
									<select class="form-control" name="niv_id" id="niv_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_nivel as $row) {
	echo '<option value="'.$row['niv_id'].'">'.$row['niv_str_referencia'].'</option>';
}
?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['tipo_novedad']?></label>
									<select class="form-control" name="tno_id" id="tno_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_tno as $row) {
	echo '<option value="'.$row['tno_id'].'">'.$row['tno_str_descripcion'].' ['.$row['tno_str_referencia'].']</option>';
}
?>
									</select>
								</div>								
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label><?=$lang['frm_registro']['estado']?></label>
									<select class="form-control" name="est_id" id="est_id" >
										<option value=""><?=$lang['sistema']['cbo_seleccione']?></option>
<?php
foreach ($array_estado as $row) {
	echo '<option value="'.$row['est_id'].'">'.$row['est_str_referencia'].' - '.$row['est_str_descripcion'].'</option>';
}
?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-8">
							<label><?=$lang['frm_registro']['edad']?></label>
								<div class="form-group">
									<div class="col-md-2">																
										<div class="form-group">De:											
											<select class="form-control" name="pob_num_edad_min" id="pob_num_edad_min" >
												<option value=""></option>
												<?php
												for($i = 0; $i < 120; $i++) {
												echo '<option value="'.$i.'">'.$i.'</option>';
												}
												?>
											</select>
										</div>							
									</div>
									<div class="col-md-2">																	
										<div class="form-group">A:											
											<select class="form-control" name="pob_num_edad_max" id="pob_num_edad_max" >
												<option value=""></option>
												<?php
												for($i = 0; $i < 120; $i++) {
												echo '<option value="'.$i.'">'.$i.'</option>';
												}
												?>
											</select>																						
										</div>							
									</div>
									<div class="col-md-1"><br>	
									<?=$lang['frm_registro']['anhos'];?>
									</div>
								</div>
							</div>
						</div>
						
						
					
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" id="btn_buscar"><?=$lang['sistema']['btn_buscar']?></button>
						
						<button type="button" class="btn btn-info" id="btn_expotar_pdf_rpt" style = "display:none;">
						  <span class="fa fa-file-pdf-o"></span> <?=$lang['sistema']['btn_pdf']?>
						</button>
						
						<button type="button" class="btn btn-info" id="btn_expotar_csv_rpt" style = "display:none;">
						  <span class="fa fa-file-archive-o"></span> <?=$lang['sistema']['btn_csv']?>
						</button>
					</div>
				</form>
				<!-- form end -->
				
			</div>
			
			
		</div>
	</div>
	
	<div id="div_listado"></div>
	
</section>
