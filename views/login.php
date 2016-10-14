<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COPres | Iniciar Sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/green.css">
    <!-- css local -->
    <link rel="stylesheet" href="../styles/login.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../index.php" title="Cero Oportunidades de Pérdida en el Régimen Subsidiado"><b>COP</b>res</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicie sesión para comenzar</p>
        <form action="../controllers/login.php" method="post" nam="formulario" id="formulario">
          <div class="form-group has-feedback">
            <input type="user" class="form-control" placeholder="Usuario" id="username" name="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">

            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn_autenticar">Ingresar</button>
            </div><!-- /.col -->
          </div>

        </form>

		    <!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> /.social-auth-links -->
        <a href="javascript:mostrar_modalpasswordreset();">Olvide mi contraseña</a>

        <div id="contenedor_warning" class="alert alert-warning alert-dismissable">
          <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
          <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
          <p id="mensaje_warning"></p>
        </div>
        <div id="contenedor_danger" class="alert alert-danger alert-dismissable">
          <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
          <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
          <p id="mensaje_danger"></p>
        </div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    
    
    <div class="modal fade" id="modalpasswordreset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close JQCancel" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="icon fa fa-warning"></i> Advertencia!</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <input type="mail" class="form-control" placeholder="Correo electrónico" id="correo_electronico" name="correo_electronico" required="">
                        <span class="icon fa fa-envelope form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="ok" id="btn-restablecer" class="btn btn-primary" type="button">Restablecer contraseña</button>
                </div>
            </div>
        </div>    
    </div>
        
    
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- script local -->
    <script src="../scripts/login.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });        
      });
      function mostrar_modalpasswordreset(){
			$('#modalpasswordreset').modal('show');    
      }
    </script>
  </body>
</html>