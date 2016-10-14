<?php
include 'template/header.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	  Realizar nueva solicitud
	  <small>CAsys</small>
	</h1>
	<ol class="breadcrumb">
	  <li><a href="<?=$actual_server;?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="#">Mis solicitudes</a></li>
	  <li class="active">Nueva</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<div class="row">
    <!-- left column -->
    <div class="col-md-8 col-md-push-2">
	  
	  <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Nueva Solicitud</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<form role="form">
		  <div class="box-body">
			<div class="form-group">
			  <label>Ciudadano</label>
			  <input type="text" class="form-control" placeholder="John McClane" disabled>
			</div>
						
			<div class="form-group">
			  <label>Tipo de Solicitud</label>&nbsp;<i class="fa fa-question-circle text-aqua"></i>
			  <select class="form-control">
				<option>Selecione el tipo de solicitud</option>
				<option>Petición</option>
				<option>Queja</option>
				<option>Reclamo</option>
				<option>Documentación</option>
				<option>Felicitación</option>
			  </select>
			</div>			
			
			<div class="form-group">
			  <label>Tema</label>&nbsp;<i class="fa fa-question-circle text-aqua"></i>
			  <select class="form-control">
				<option>Selecione el tema al que pertenece su solicitud</option>
				<option>Tema1 -> Subtema1</option>
				<option>Tema1 -> Subtema2</option>
				<option>Tema1 -> Subtema2 -> subtema1 nivel 3</option>
				<option>Tema1 -> Subtema2 -> subtema2 nivel 3</option>
				<option>Tema1 -> Subtema3</option>
				<option>Tema2</option>
				<option>Tema3 -> Subtema1</option>
				<option>Tema3 -> Subtema2</option>
				<option>Tema3 -> Subtema3 -> subtema1 nivel 3</option>
				<option>Tema3 -> Subtema3 -> subtema2 nivel 3</option>
			  </select>
			</div>	
			
			<div class="form-group">
			  <label>Descripción de la solicitud</label>&nbsp;<i class="fa fa-question-circle text-aqua"></i>
			  <textarea class="form-control" rows="3" placeholder="Descripción..."></textarea>
			</div>
						
			<div class="form-group">
			  <label for="exampleInputFile">Archivo Adjunto</label>
			  <input type="file" id="exampleInputFile">
			  <p class="help-block">Solo se admiten archivos jpg, png o pdf; máximo 2 Mb de tamaño.</p>
			</div>
			
			<div class="checkbox">
			  <label>
				<input type="checkbox"> Requiero notificación a mi domicilio.
			  </label>
			</div>
		  </div><!-- /.box-body -->

		  <div class="box-footer">
			<button type="submit" class="btn btn-primary">Enviar Solicitud</button>
		  </div>
		</form>
	  </div><!-- /.box -->

	  
	  

	</div><!--/.col (left) -->
	
	
	<!-- right column -->
	<div class="col-md-6">
	  
    </div><!--/.col (right) -->
</div>   <!-- /.row -->

</section><!-- /.content -->
<?php
include 'template/footer.php';
?>
