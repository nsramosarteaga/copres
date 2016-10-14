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
	
    <div class="row" id="div_formulario">
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$lang['mantenimiento']['subtitulo']?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="listado_eps" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:30%"><?=$lang['tbl_eps']['codigo']?></th>
                                <th style="width:60%"><?=$lang['tbl_eps']['nombre']?></th>
                                <th style="width:10%"><?=$lang['tbl_eps']['opciones']?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($array_eps as $row)
                            {?>
                                <tr>
                                    <td><?=$row['eps_str_codigo']?></td>
                                    <td><?=$row['eps_str_nombre']?></td>
                                    <td class="text-center">
                                        <form action="editar.php" id="form_editar_<?=$row['eps_id']?>" name="form_editar_<?=$row['eps_id']?>" method="post" >
                                            <input type="hidden" value="<?=$row['eps_id']?>" id="eps_id" name="eps_id">
                                        </form>
                                        <a title="<?=$lang['sistema']['btn_modificar']?>" href="#" class="btn btn-primary btn-xs" onclick="modificarEPS('<?=$row['eps_id']?>')"><i class="fa fa-pencil"></i></a>
                                        <a title="<?=$lang['sistema']['btn_eliminar']?>" href="#" class="btn btn-danger btn-xs" onclick="eliminarEPS('<?=$row['eps_id']?>')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr><?php
                            }?>
                        </tbody>
                    </table><!-- /.table -->
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn_nuevo_eps"><?=$lang['sistema']['btn_nuevo']?></button>
                </div>

            </div><!-- /.box -->
	</div>
    </div>   <!-- /.row -->

</section><!-- /.content -->
