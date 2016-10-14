<?php
include '../config/config.inc';
$contenido =$_POST['contenido'];
$filename =$_POST['filename'];
$pagesize = (isset($_POST['pagesize'])?$_POST['pagesize']:'LETTER');
$pageorientation = (isset($_POST['pageorientation'])?$_POST['pageorientation']:'P');
$margenes = array(10, 10, 20, 10);
include_once('../local/es_CO.php'); // Idioma
if($pageorientation=='P'){
	$width = "width:670px;";
	/*
	$header='<div style="padding:0mm 0mm -5mm 0mm; width:680px; height:95px; margin-bottom:10mm; border: solid 1px #e0e0e0;">
			<img src="../img/escudo_mariquita_small.png" width="60" height="72" style="margin:1mm 0mm 0mm 0mm; display:inline-block width:60px" />
			<div style="margin:-20mm 0mm 5mm 25mm; display:inline-block; width:445px; text-align:center; border: solid 1px #e0e0e0;">
				<p style="font-size:12pt; color:black;">
				'.$lang['copyright']['empresa'].'<br/>
				'.$lang['copyright']['secretaria'].'<br/>
				</p>
			</div>
			<img src="../img/bandera_mariquita_small.jpg" width="90" height="60" style="display:inline-block; width:90px; margin:0px 0px 0px 650px;" />
		</div>';
	*/
	$header = '<div style="text-align:center; margin-bottom:680px; width:680px;">
		<table style="padding:0px; border-collapse:collapse; width:680px; text-align:center; border: solid 0px #ffffff; font-size:85%;" >
		<tr>
			<td rowspan="3" style="padding:3px; text-align:center; width:90px; border: solid 1px #acacac;">
				<img src="../img/escudo_mariquita_small.png" style="margin:0px; width:60px; height:72px" />
			</td>
			<td colspan="3" style="padding:3px; width:500px; text-align:center; border: solid 1px #acacac;">'.$lang['copyright']['empresa'].'</td>
			<td rowspan="3" style="padding:9px 3px; text-align:center; width:90px; border: solid 1px #acacac;">
				<img src="../img/bandera_mariquita_small.jpg" style="margin:0px; width:90px; height:60px" />
			</td>
		</tr>
		
		<tr>
			<td colspan="3" style="padding:0px; text-align:center; border: solid #acacac;">' . 
			$lang['copyright']['secretaria'] . '<br>' . $lang['formato_rpt']['coddoc'] . 
			'</td>
		</tr>
		
		<tr>
			<td style="padding:0px; text-align:center; border: solid 1px #acacac;">'.$lang['formato_rpt']['fecha'].'</td>
			<td style="padding:0px; text-align:center; border: solid 1px #acacac;">'.$lang['formato_rpt']['version'].'</td>
			<td style="padding:0px; text-align:center; border: solid 1px #acacac;">Página [[page_cu]] de [[page_nb]]</td>
		</tr>
		
		</table>
		</div>';
}
ob_start();?>
<!-- <link rel="stylesheet" href="<?=$config['url_aplicacion']?>bootstrap/css/bootstrap.min.css">-->
<style type="text/css">
	.standard
	{
		margin-top: 20mm;
		padding-left: 10mm;
	}
	
	table {
		width: 100%;
		max-width: 100%;
		margin-bottom: 20px;
		border: 1px solid #444444;
		background-color:#ffffff;
	}
	
	table thead tr, table thead tr th{
		background-color:#C5C5C5;
		padding:3px 1px;
		text-align:center;
	}
	.par{background-color: #E6E6FA; padding:2px 0px;}
	.impar{background-color: #EEEEEE; padding:2px 0px;}
</style>
<page format="<?=$pagesize?>" orientation="<?=$pageorientation?>" backtop="22mm" backbottom="14mm" backleft="0mm" backright="10mm" style="font-size:8.5pt">	
      <page_header>
		<?=$header?>
		<br>
	  </page_header>
      <page_footer>
		<div style="padding:5mm 10mm -5mm 10mm; <?=$width?> font-size:8pt; color:black; text-align:center;">		
			<p> <?=$lang['copyright']['eslogan'];?><br/>
				<?=$lang['copyright']['direccion'];?><br/>
				<?=$lang['copyright']['correo'];?><br/>
				<?=$lang['copyright']['codpostal'];?>
			</p>
		</div>
      </page_footer>
	  <div style="padding: 10mm 5mm 0mm 0mm; font-size: 85%;">
		<?=$contenido;?>
	  </div>	
 </page>
 
 
 <?php
$content = ob_get_clean();
require_once('../lib/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','LETTER','es', true, 'UTF-8',$margenes);
$html2pdf->writeHTML($content);
$content = $html2pdf->Output('',true);

$file = fopen($filename, "w");
fwrite($file, $content);
fclose($file);
	
?>
