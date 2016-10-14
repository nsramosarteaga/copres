<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$lang['mantenimiento']['titulo']?>
        <small><?=$lang['nombre_corto_proyecto']?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><?=$lang['mnu_mantenimiento']['titulo']?></a></li>
      <li class="active"><?=$lang['mnu_mantenimiento']['item_1']?></li>
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
                <div class="box-body"><?=$lang['frm_eps']['actualizando']?></div><!-- /.box-body -->
                <!-- Loading (remove the following to stop the loading)-->
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- end loading -->
            </div><!-- /.box -->
        </div>
    </div>
    <!-- fin DIV carga -->
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
                    <a href="<?=$config['url_aplicacion'].'controllers/eps/index.php'?>" class="btn btn-success btn-sm pull-right" role="button"><?=$lang['sistema']['btn_continuar']?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- fin DIV exitoso -->
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
    <!-- fim DIV error -->
    
    <div class="row" id="div_formulario">
        <div class="col-md-4 col-md-push-4">

            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$lang['mantenimiento']['eps_nuevo']?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    <?php //print_r($eps); ?>

                    <!-- form start -->
                    <form role="form" id="formulario_eps" data-parsley-validate="">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?=$lang['frm_eps']['codigo']?></label>
                                    <input type="text" class="form-control input_capital" required="" data-parsley-type="alphanum" data-parsley-length="[2, 16]" placeholder="Solo números y letras" id="eps_str_codigo" name="eps_str_codigo" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?=$lang['frm_eps']['nombre']?></label>
                                    <input type="text" class="form-control input_capital" required="" data-parsley-length="[4, 128]" id="eps_str_nombre" name="eps_str_nombre" value="">
                                </div>
                            </div>
                        </div>
                    </form><!-- /form -->
                              

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-warning" id="btn_cancelar" onClick="location.href='<?=$config['url_aplicacion'];?>controllers/eps/index.php'"><?=$lang['sistema']['btn_cancelar']?></button>
                    <button type="submit" class="btn btn-primary" id="btn_guardar_eps"><?=$lang['sistema']['btn_guardar']?></button>
                </div>

            </div><!-- /.box -->
	</div>
    </div>   <!-- /.row -->

</section><!-- /.content -->