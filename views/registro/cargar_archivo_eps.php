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
	    <div class="col-md-10 col-md-push-1">			
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
							  <label for="pob_str_adjunto_eps"><?=$lang['frm_registro']['adjunto']?></label>
							  <input type="file" id="pob_str_adjunto_eps" name="pob_str_adjunto_eps">
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
					
					<!--- Inicio Total coincidentes -->
					<div id="div_listado_coincidencias" class="box box-solid">
						<?php
						if(!empty($array_resultado_pob_tmp_coincidencias))
						{
						?>
							<div class="box-header with-border">
							  <h3 class="box-title"><?=$lang['registro']['titulo_eps_coincidencia']?></h3>
							</div>						
							<table id='resultados_coincidencias' class='display' cellspacing='0' width='96%' style='font-size:8pt; margin: 10px 2%;'>
							<thead>
								<tr>
									<th>Item</th>
									<th>Tipo</th> 
									<th>Documento</th>
									<th>Primer Apellido</th>
									<th>Segundo Apellido</th>
									<th>Primer Nombre</th>
									<th>Segundo Nombre</th>	
									<th>Fecha Nacimiento</th>
									<th>Estado</th>
									<th>EPS</th>
									<!--<th>Opciones</th>-->
								</tr>
							</thead>
							<tbody>
								<?php
								$num_pob_tmp = count($array_resultado_pob_tmp_coincidencias);
								$clase_fila = array(0=>'par',1=>'impar');
								for($i = 0; $i < $num_pob_tmp; $i++)
								{
									$bgcolor = (($i % 2) == 0)? 'bgcolor="#DCEDEC"': "";
									
									//$bgcolor = ($array_resultado_pob_tmp_coincidencias[$i]["pob_id2"] != "") ? 'bgcolor="#00DE00"' : $bgcolor;
									echo "<tr ".$bgcolor.">";
									echo "<td class=\"text-center\">".($i+1)."</td>";
									echo "<td class=\"text-center\">".$array_resultado_pob_tmp_coincidencias[$i]["tdo_id"]."</td>";
									echo "<td>".$array_resultado_pob_tmp_coincidencias[$i]["pob_str_documento"]."</td>";
									echo "<td>".$array_resultado_pob_tmp_coincidencias[$i]["pob_str_apellido1"]."</td>";
									echo "<td>".$array_resultado_pob_tmp_coincidencias[$i]["pob_str_apellido2"]."</td>";
									echo "<td>".$array_resultado_pob_tmp_coincidencias[$i]["pob_str_nombre1"]."</td>";
									echo "<td>".$array_resultado_pob_tmp_coincidencias[$i]["pob_str_nombre2"]."</td>";
									echo "<td class=\"text-center\">".$array_resultado_pob_tmp_coincidencias[$i]["pob_dat_fechaNacimiento"]."</td>";
									echo "<td class=\"text-center\">".$array_resultado_pob_tmp_coincidencias[$i]["est_id"]."</td>";
									echo "<td class=\"text-center\">".$array_resultado_pob_tmp_coincidencias[$i]["eps_id"]."</td>";
									
									echo "</tr>";				
								}
								?>									
							</tbody>
							</table>
							<div class="box-footer with-border">
								<a href="#" id="btn_export_coincidencias" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Descargar CSV</a>
							</div>
						<?php
						}
						?>
					</div>
					<!--- Fin Total coincidentes -->
					
					<!--- Inicio Coincidentes parciales -->
					<div id="div_listado_coincidencias_parciales" class="box box-solid">
						<?php
						if(!empty($array_parciales))
						{
						?>
							<div class="box-header with-border">
							  <h3 class="box-title"><?=$lang['registro']['titulo_eps_coincidencia_parcial']?></h3>
							</div>						
							<table id='resultados_coincidencias_parciales' class='display' cellspacing='0' width='96%' style='font-size:8pt; margin: 10px 2%;'>
								<thead>
									<tr>
									<th>Item</th>
									<th>Tipo</th> 
									<th>Documento</th>
									<th>Primer Apellido</th>
									<th>Segundo Apellido</th>
									<th>Primer Nombre</th>
									<th>Segundo Nombre</th>	
									<th>Fecha Nacimiento</th>
									<th>Estado</th>
									<th>EPS</th>
									<th>Coincidencias</th>
									</tr>
								</thead>
								<tbody>
								<?php
									
									//echo '<pre>';
									//print_r($array_parciales);
									//echo '</pre>';															
									
									$num_pob_tmp = count($array_parciales);
									$clase_fila = array(0=>'par',1=>'impar');
									for($i = 0; $i < $num_pob_tmp; $i++)
									{										
										
										$bgcolor = (($i % 2) == 0)? 'bgcolor="#DCEDEC"': "";										
										//$bgcolor = ($array_resultado_pob_tmp_no_coincidencias[$i]["pob_id2"] != "") ? 'bgcolor="#F4AC7C"' : $bgcolor;
										echo "<tr ".$bgcolor.">";
										echo "<td class=\"text-center\">".($i+1)."</td>";
										echo "<td class=\"text-center\">".$array_parciales[$i]["tdo_id"]."</td>";
										echo "<td>".$array_parciales[$i]["pob_str_documento"]."</td>";
										echo "<td>".$array_parciales[$i]["pob_str_apellido1"]."</td>";
										echo "<td>".$array_parciales[$i]["pob_str_apellido2"]."</td>";
										echo "<td>".$array_parciales[$i]["pob_str_nombre1"]."</td>";
										echo "<td>".$array_parciales[$i]["pob_str_nombre2"]."</td>";
										echo "<td class=\"text-center\">".$array_parciales[$i]["pob_dat_fechaNacimiento"]."</td>";
										echo "<td class=\"text-center\">".$array_parciales[$i]["est_id"]."</td>";
										echo "<td class=\"text-center\">".$array_parciales[$i]["eps_id"]."</td>";
										echo "<td> Cantidad: " . 
											$array_parciales[$i]["num_coincidencia"] ."<br/>". 
											implode("<br/>",$array_parciales[$i]["campos_coincidencia"]).
											"</td>";
										echo "</tr>";																	
									}
								?>
								</tbody>						
							</table>
							<div class="box-footer with-border">
								<a href="#" id="btn_export_coincidencias_parciales" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Descargar CSV</a>
							</div>							
						<?php 
						}
						?>							
					</div>
					<!--- Fin Coincidentes parciales -->
					
					<!--- Inicio estan en EPS, pero no en Copres -->
					<div id="div_listado_no_copres" class="box box-solid">
						<?php
						
						if(!empty($array_no_copres))
						{
						?>
							<div class="box-header with-border">
							  <h3 class="box-title"><?=$lang['registro']['titulo_eps_no_copres']?></h3>
							</div>						
							<table id='resultados_no_copres' class='display' cellspacing='0' width='96%' style='font-size:8pt; margin: 10px 2%;'>
								<thead>
									<tr>
									<th>Item</th>
									<th>Tipo</th> 
									<th>Documento</th>
									<th>Primer Apellido</th>
									<th>Segundo Apellido</th>
									<th>Primer Nombre</th>
									<th>Segundo Nombre</th>	
									<th>Fecha Nacimiento</th>
									<th>Estado</th>
									<th>EPS</th>
									<!--<th>Opciones</th>-->
									</tr>
								</thead>
								<tbody>
								<?php
									/*
									echo '<pre>';
									print_r($array_no_copres);
									echo '</pre>';															
									*/
									$num_pob_tmp = count($array_no_copres);
									$clase_fila = array(0=>'par',1=>'impar');
									for($i = 0; $i < $num_pob_tmp; $i++)
									{										
										
										$bgcolor = (($i % 2) == 0)? 'bgcolor="#DCEDEC"': "";										
										//$bgcolor = ($array_resultado_pob_tmp_no_coincidencias[$i]["pob_id2"] != "") ? 'bgcolor="#F4AC7C"' : $bgcolor;
										echo "<tr ".$bgcolor.">";
										echo "<td class=\"text-center\">".($i+1)."</td>";
										echo "<td class=\"text-center\">".$array_no_copres[$i]["tdo_id"]."</td>";
										echo "<td>".$array_no_copres[$i]["pob_str_documento"]."</td>";
										echo "<td>".$array_no_copres[$i]["pob_str_apellido1"]."</td>";
										echo "<td>".$array_no_copres[$i]["pob_str_apellido2"]."</td>";
										echo "<td>".$array_no_copres[$i]["pob_str_nombre1"]."</td>";
										echo "<td>".$array_no_copres[$i]["pob_str_nombre2"]."</td>";
										echo "<td class=\"text-center\">".$array_no_copres[$i]["pob_dat_fechaNacimiento"]."</td>";
										echo "<td class=\"text-center\">".$array_no_copres[$i]["est_id"]."</td>";
										echo "<td class=\"text-center\">".$array_no_copres[$i]["eps_id"]."</td>";
										
										echo "</tr>";																	
									}
								?>
								</tbody>						
							</table>
							<div class="box-footer with-border">
								<a href="#" id="btn_export_no_copres"  class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Descargar CSV</a>
							</div>							
						<?php 
						}
						?>							
					</div>
					<!--- Fin estan en EPS, pero no en Copres -->
					
					
					<!--- Inicio estan en Copres, pero no en la EPS -->					
					<div id="div_listado_no_eps" class="box box-solid">	
						<?php
						if(!empty($array_resultado_pob_tmp_eps))
						{
						?>
							<div class="box-header with-border">
							  <h3 class="box-title"><?=$lang['registro']['titulo_eps_no_eps']?></h3>
							</div>
							<table id='resultados_no_eps' class='display' cellspacing='0' width='96%' style='font-size:8pt; margin: 10px 2%;'>
								<thead>
									<tr>
									<th>Item</th>
									<th>Tipo</th> 
									<th>Documento</th>
									<th>Primer Apellido</th>
									<th>Segundo Apellido</th>
									<th>Primer Nombre</th>
									<th>Segundo Nombre</th>	
									<th>Fecha Nacimiento</th>
									<th>Estado</th>
									<th>EPS</th>
									<!--<th>Opciones</th>-->
									</tr>
								</thead>
								<tbody>
								<?php
									//echo '<pre>';
									//print_r($array_resultado_pob_tmp_eps);
									//echo '</pre>';				
										
									$num_pob_tmp = count($array_resultado_pob_tmp_eps);
									$clase_fila = array(0=>'par',1=>'impar');
									for($i = 0; $i < $num_pob_tmp; $i++)
									{
										$bgcolor = (($i % 2) == 0)? 'bgcolor="#DCEDEC"': "";
										
										//$bgcolor = ($array_resultado_pob_tmp_no_coincidencias[$i]["pob_id2"] != "") ? 'bgcolor="#F4AC7C"' : $bgcolor;
										echo "<tr ".$bgcolor.">";
										echo "<td class=\"text-center\">".($i+1)."</td>";
										echo "<td class=\"text-center\">".$array_resultado_pob_tmp_eps[$i]["tdo_id"]."</td>";
										echo "<td>".$array_resultado_pob_tmp_eps[$i]["pob_str_documento"]."</td>";
										echo "<td>".$array_resultado_pob_tmp_eps[$i]["pob_str_apellido1"]."</td>";
										echo "<td>".$array_resultado_pob_tmp_eps[$i]["pob_str_apellido2"]."</td>";
										echo "<td>".$array_resultado_pob_tmp_eps[$i]["pob_str_nombre1"]."</td>";
										echo "<td>".$array_resultado_pob_tmp_eps[$i]["pob_str_nombre2"]."</td>";
										echo "<td class=\"text-center\">".$array_resultado_pob_tmp_eps[$i]["pob_dat_fechaNacimiento"]."</td>";
										echo "<td class=\"text-center\">".$array_resultado_pob_tmp_eps[$i]["est_id"]."</td>";
										echo "<td class=\"text-center\">".$array_resultado_pob_tmp_eps[$i]["eps_id"]."</td>";
										
										echo "</tr>";
									}
								?>
								</tbody>
							</table>
							<div class="box-footer with-border">
								<a href="#" id="btn_export_no_eps" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Descargar CSV</a>
							</div>
							<?php
						}
						?>
					</div>
					<!--- Fin estan en Copres, pero no en la EPS -->
					
					
					<div class="box box-solid">
						<div class="box-header with-border"></div>
					</div>
					
				</form>
				<!-- form end -->

			</div><!-- /.box -->
	    </div>
	</div>   <!-- /.row -->
	
	
	
</section><!-- /.content -->
