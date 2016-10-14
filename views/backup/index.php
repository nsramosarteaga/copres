<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$lang['mantenimiento']['titulo_3']?>
        <small><?=$lang['nombre_corto_proyecto']?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><?=$lang['mnu_mantenimiento']['titulo']?></a></li>
      <li class="active"><?=$lang['mnu_mantenimiento']['item_3']?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	
    <div class="row" id="div_formulario">
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$lang['mantenimiento']['subtitulo_3']?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if($existe_backup){?>
                        <a href="<?=$config['url_aplicacion']?>backup/<?=$nombre_archivo_bkp?>"> <span class="glyphicon glyphicon-floppy-save"></span>&nbsp;<?=$lang['backup']['descargar']?></><?php
                    }else{?>
                        <div class="alert alert-warning fade in">
                            <!--
                            <button data-dismiss="alert" class="close close-md" type="button">
                                <i class="fa fa-times"></i>
                            </button> -->
                            <span class="fa fa-warning"></span>
                            <strong>Advertencia!</strong> El archivo de la copia de respaldo no se ha generado, por favor comuniquese con el administrador de la aplicación.
                        </div><?php
                    }
                    ?>                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <!-- <button type="submit" class="btn btn-primary" id="btn_guardar"><?=$lang['sistema']['btn_guardar']?></button> -->
                </div>

            </div><!-- /.box -->
	</div>
    </div>   <!-- /.row -->

</section><!-- /.content -->