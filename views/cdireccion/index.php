<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$lang['mantenimiento']['titulo_2']?>
        <small><?=$lang['nombre_corto_proyecto']?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=$config['url_aplicacion'];?>controllers/inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><?=$lang['mnu_mantenimiento']['titulo']?></a></li>
      <li class="active"><?=$lang['mnu_mantenimiento']['item_2']?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
    <div class="row" id="div_formulario">
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$lang['mantenimiento']['subtitulo_2']?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="listado_cdireccion" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:50%"><?=$lang['tbl_cdireccion']['nombre']?></th>
                                <th style="width:40%"><?=$lang['tbl_cdireccion']['tipo']?></th>
                                <th style="width:10%"><?=$lang['tbl_cdireccion']['opciones']?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($array_cdireccion as $row)
                            {?>
                                <tr>
                                    <td><?=$row['cdi_str_nombre']?></td>
                                    <td><?php
                                    if($row['cdi_str_tipo']=="B"){
                                        echo "Barrio";
                                    }elseif($row['cdi_str_tipo']=="V"){
                                        echo "Vereda";
                                    }else{
                                        echo "No encontrado";
                                    }
                                    ?></td>
                                    <td class="text-center">
                                        <form action="editar.php" id="form_editar_<?=$row['cdi_id']?>" name="form_editar_<?=$row['cdi_id']?>" method="post" >
                                            <input type="hidden" value="<?=$row['cdi_id']?>" id="eps_id" name="cdi_id">
                                        </form>
                                        <a title="<?=$lang['sistema']['btn_modificar']?>" href="#" class="btn btn-primary btn-xs" onclick="modificarCdireccion('<?=$row['cdi_id']?>')"><i class="fa fa-pencil"></i></a>
                                        <a title="<?=$lang['sistema']['btn_eliminar']?>" href="#" class="btn btn-danger btn-xs" onclick="eliminarCdireccion('<?=$row['cdi_id']?>')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr><?php
                            }?>
                        </tbody>
                    </table><!-- /.table -->                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn_nuevo_cdireccion"><?=$lang['sistema']['btn_nuevo']?></button>
                </div>

            </div><!-- /.box -->
	</div>
    </div>   <!-- /.row -->

</section><!-- /.content -->