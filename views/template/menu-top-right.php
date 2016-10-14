            <!-- Navbar Right Menu -->

              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?=$config['url_aplicacion'];?>dist/img/icon-user-default.png" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?=$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario'];?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?=$config['url_aplicacion'];?>dist/img/icon-user-default.png" class="img-circle" alt="User Image">
                        <p>
<?=$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario'];?>
                          <small>Username: <?=$_SESSION['username']?></small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <!---
                      <li class="user-body">
                        <div class="col-xs-12 text-center">
                          <small></small>
                        </div>

                        <div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>

                      </li>
                      -->
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <!--
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Perfil</a>
                        </div>
                        -->
                        <div class="pull-right">
                          <a href="<?=$config['url_aplicacion'];?>controllers/salir.php" class="btn btn-default btn-flat"><?=$lang['sistema']['salir']?></a>
                        </div>
                      </li>
                    </ul>
                  </li>

                </ul>
               </div><!-- /.navbar-custom-menu -->

