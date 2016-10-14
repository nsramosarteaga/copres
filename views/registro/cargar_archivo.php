<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	  <?=$lang['registro']['titulo_3']?>
	  <small><?=$lang['nombre_corto_proyecto']?></small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> <?=$lang['mnu_inicio'];?></a></li>
	  <li><a href="#"><?=$lang['mnu_registro']['titulo']?></a></li>
	  <li class="active"><?=$lang['mnu_registro']['item_3']?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
	
	<div class="row" id="div_formulario">
	    <div class="col-md-8 col-md-push-2">
		
			
	    	<!-- general form elements -->
		  	<div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title"><?=$lang['registro']['subtitulo_3']?></h3>
				</div><!-- /.box-header -->

				<!-- form start -->
				<form method = "post" role="form" id="formulario" data-parsley-validate="" action = "<?=$_SERVER['PHP_SELF']?>"  enctype="multipart/form-data">
				  	<div class="box-body">
				  		<div class="col-md-12">
							<div class="form-group">
							  <label for="pob_str_adjunto"><?=$lang['frm_registro']['adjunto']?></label>
							  <input type="file" id="pob_str_adjunto" name="pob_str_adjunto">
							  <p class="help-block"><?=$lang['frm_registro']['help_adjunto_csv']?></p>
							</div>
						</div>

					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" id="btn_cargar"><?=$lang['sistema']['btn_cargar']?></button>
					</div>
					<div class="box-footer">
						<?php
						if($msg_registro_pob != "")
						{
							echo "Observaciones:<br>".$msg_registro_pob;
						}
						?>
					</div>
				</form>
				<!-- form end -->

			</div><!-- /.box -->
	    </div>
	</div>   <!-- /.row -->
	
	
	
</section><!-- /.content -->
