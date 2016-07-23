<!DOCTYPE html>
<html>
<head>
   <!-- META TAGS -->
   <meta charset="ISO-8859-1">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <base href="<?=base_url()?>">
   
   <title>Nutrative</title>

   <!-- CSS -->
   <link type="text/css" rel="stylesheet" href="vendor/jquery-ui/jquery-ui.min.css">
   <link type="text/css" rel="stylesheet" href="vendor/fullcalendar/fullcalendar.css">
   <link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
   <link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap-theme.min.css">
   <link type="text/css" rel="stylesheet" href="css/geral.css">
   <link type="text/css" rel="stylesheet" href="css/topo.css">
   <link type="text/css" rel="stylesheet" href="css/nutri/cliente.css">
   <link type="text/css" rel="stylesheet" href="css/lateral.css">
   <link type="text/css" rel="stylesheet" href="css/nutri/filtro.css">
   <?=$htmlCss;?>

   <!-- JS VENDOR -->
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery-2.1.3.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery.maskedinput.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery.maskMoney.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/vendor/jquery.ui.widget.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/jquery.iframe-transport.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/jquery.fileupload.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/fullcalendar/lib/moment.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/fullcalendar/fullcalendar.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/highcharts/js/highcharts.js"></script>
   <script type="text/javascript" src="js/geral.js"></script>
   <?=$htmlJs;?>
</head>
<body>
	<header id="bgTopo">
		<div class="content">
			<div class="logo">
				<a href=""><img alt="" src="img/nutri/layout/logo-branco.png"></a>
			</div>
			<div class="hello">
				<p>Ol� <?=$nutr->nome;?>!</p>
			</div>
			<div class="setting">
				<a href="javascript:modalSetting();"><img alt="" src="img/nutri/layout/settings.png"></a>
				<div id="modSetting">
					<div class="modal-setting">
						<div class="top">
							<a href="javascript: modalSetting();" class="btFechar">X</a>
							<p>Configura��es</p>
						</div>
						<div class="bottom">
							<div class="box">
								<ul>
									<li><a href="index.php/nutri/inicio/logout">Logout</div>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>








