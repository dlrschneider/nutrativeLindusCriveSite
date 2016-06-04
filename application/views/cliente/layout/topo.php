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
   <link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
   <link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap-theme.min.css">
   <link type="text/css" rel="stylesheet" href="css/nutri/geral.css">
   <link type="text/css" rel="stylesheet" href="css/nutri/topo.css">
   <link type="text/css" rel="stylesheet" href="css/nutri/lateral.css">
   <?=$htmlCss;?>

   <!-- JS VENDOR -->
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery-2.1.3.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery.maskedinput.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/vendor/jquery.ui.widget.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/jquery.iframe-transport.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/jquery/fileupload/js/jquery.fileupload.js"></script>
   <script type="text/javascript" src="<?=base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
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
				<p>Olá <?=$clie->nome;?>!</p>
			</div>
			<div class="setting">
				<a href="javascript:modalSetting();"><img alt="" src="img/nutri/layout/settings.png"></a>
				<div id="modSetting">
					<div class="modal-setting">
						<div class="top">
							<a href="javascript: modalSetting();" class="btFechar">X</a>
							<p>Configurações</p>
						</div>
						<div class="bottom">
							<div class="box">
								<ul>
									<li><a href="index.php/nutri/dashboard">Config. Gerais</a></li>
									<li><a href="index.php/nutri/clientes">Ajustar</a></li>
									<li><a href="index.php/nutri/dietas">Logout</div>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>








