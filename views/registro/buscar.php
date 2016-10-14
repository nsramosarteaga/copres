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
	
	<div class="row" id="div_formulario">
	    <div class="col-md-12">

	    	<!-- general form elements -->
		  	<div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title"><?=$lang['registro']['subtitulo_2']?></h3>
				</div><!-- /.box-header -->

				
				  	<div class="box-body">
						<?php
						//var_dump($array_poblacion);
						?>
						<table id="registroBuscarDatatable" class="display" cellspacing="0" width="100%" style="font-size:8pt">
							<thead>
								<tr>
									<th><?=$lang['tbl_registro']['tipo_doc']?></th>
									<th><?=$lang['tbl_registro']['num_documento']?></th>
									<th width="8%"><?=$lang['tbl_registro']['ape_1']?></th>
									<th width="8%"><?=$lang['tbl_registro']['ape_2']?></th>
									<th width="8%"><?=$lang['tbl_registro']['nom_1']?></th>
									<th width="8%"><?=$lang['tbl_registro']['nom_2']?></th>
									<th><?=$lang['tbl_registro']['fec_nac']?></th>
									<th><?=$lang['tbl_registro']['eps']?></th>
									<th width="6%"><?=$lang['tbl_registro']['genero']?></th>
									<th width="6%"><?=$lang['tbl_registro']['estado']?></th>
									<th><?=$lang['tbl_registro']['poblacion']?></th>
									<th width="6%"><?=$lang['tbl_registro']['nivel']?></th>
									<th><?=$lang['tbl_registro']['opciones']?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($array_poblacion as $row)
									{
										?>
										<tr>
											<td><?=$row['tdo_str_referencia']?></td>
											<td><?=$row['pob_str_documento']?></td>
											<td><?=$row['pob_str_apellido1']?></td>
											<td><?=$row['pob_str_apellido2']?></td>
											<td><?=$row['pob_str_nombre1']?></td>
											<td><?=$row['pob_str_nombre2']?></td>
											<td><?=$row['pob_dat_fechaNacimiento']?></td>
											<td><?=$row['eps_str_nombre']?></td>
											<td><?=$row['sex_str_referencia']?></td>
											<td><?=$row['est_str_referencia']?></td>
											<td><?=$row['cpo_str_descripcion']?></td>
											<td><?=$row['niv_str_referencia']?></td>
											<td>
												<form action="editar.php" id="form_editar_<?=$row['pob_id']?>" name="form_editar_<?=$row['pob_id']?>" method="post" >
													<input type="hidden" value="<?=$row['pob_id']?>" id="pob_id" name="pob_id">
												</form>
												<a title="<?=$lang['sistema']['btn_ver']?>" href="#" class="btn btn-info btn-xs" onclick="alert('ver información')"><i class="fa fa-search"></i></a>
												<a title="<?=$lang['sistema']['btn_modificar']?>" href="#" class="btn btn-primary btn-xs" onclick="modificarRegistro('<?=$row['pob_id']?>')"><i class="fa fa-pencil"></i></a>
												<a title="<?=$lang['sistema']['btn_eliminar']?>" href="#" class="btn btn-danger btn-xs" onclick="eliminarRegistro('<?=$row['pob_id']?>')"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
										<?php
									}										
								?>
							</tbody>
						</table>
						
					</div><!-- /.box-body -->

					<div class="box-footer">
						<!-- <button type="submit" class="btn btn-primary" id="btn_guardar"><?=$lang['sistema']['btn_guardar']?></button> -->
					</div>

			</div><!-- /.box -->
	    </div>
	</div>   <!-- /.row -->

</section><!-- /.content -->
