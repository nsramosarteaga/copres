            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <!--
                <li class="active"><a href="#">Link 1<span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link 2</a></li>
                -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang['mnu_registro']['titulo']?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/registro"><?=$lang['mnu_registro']['item_1']?></a></li>
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/registro/buscarCriterios.php"><?=$lang['mnu_registro']['item_2']?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/registro/cargar_archivo.php"><?=$lang['mnu_registro']['item_3']?></a></li>
						<li><a href="<?=$config['url_aplicacion'];?>controllers/registro/dep_interna.php"><?=$lang['mnu_registro']['item_5']?></a></li>
						<li class="divider"></li>
                       <li><a href="<?=$config['url_aplicacion'];?>controllers/registro/cargar_archivo_eps.php"><?=$lang['mnu_registro']['item_6']?></a></li>
					   <!--
					   <? if($_GET['mode'] == 'dllo'){ ?> <li><a href="<?=$config['url_aplicacion'];?>controllers/registro/cargar_archivo_eps.php"><?=$lang['mnu_registro']['item_6']?></a></li> <? } ?>
					   -->
                        <!--<li><a href="#"><?=$lang['mnu_registro']['item_2']?></a></li>-->
                    </ul>
                </li>
		<!-- Menú Reporte -->		
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang['mnu_reporte']['titulo']?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/reporte"><?=$lang['mnu_reporte']['item_1']?></a></li>
                    </ul>
                </li>                
                <!-- Menú Mantenimiento -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang['mnu_mantenimiento']['titulo']?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/eps"><?=$lang['mnu_mantenimiento']['item_1']?></a></li>
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/cdireccion"><?=$lang['mnu_mantenimiento']['item_2']?></a></li>
                        <li><a href="<?=$config['url_aplicacion'];?>controllers/backup"><?=$lang['mnu_mantenimiento']['item_3']?></a></li>
                    </ul>
                </li>
                
              </ul>
              <!--
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Buscar">
                </div>
              </form>
              -->
            </div><!-- /.navbar-collapse -->
