<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$lang['nombre_corto_proyecto'];?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=$config['url_aplicacion'];?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="<?=$config['url_aplicacion'];?>plugins/datepicker/datepicker3.css">
	<!-- Parsley -->
    <link rel="stylesheet" href="<?=$config['url_aplicacion'];?>plugins/parsley/parsley.css">
	<!-- datatables -->
	<link rel="stylesheet" href="<?=$config['url_aplicacion'];?>plugins/datatables2/media/css/jquery.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$config['url_aplicacion'];?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=$config['url_aplicacion'];?>dist/css/skins/skin-green-light.min.css">
	<!-- CSS Locales -->
	<link rel="stylesheet" href="<?=$config['url_aplicacion'];?>styles/copres.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-green-light layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">

            <div class="navbar-header">
              <a href="<?=$config['url_aplicacion'];?>controllers/inicio.php" title="<?=$lang['nombre_proyecto']?>" class="navbar-brand"><b><?=$lang['sigla_uno_proyecto']?></b><?=$lang['sigla_dos_proyecto']?></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
<?php
include ('menu-top-left.php')
?>
<?php
include ('menu-top-right.php')
?></div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
