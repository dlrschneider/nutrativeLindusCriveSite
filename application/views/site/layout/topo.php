<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="Nutrative" />
	<meta name="copyright" content="Copyright Â©2016 - F5.6" />
	<meta name="keywords" content="" />
	<meta name="description" content="Nutrative" />

	<!-- Style -->	
	<meta property="fb:app_id" content="123456" />
	<meta property="og:title" content="nutrative" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:site_name" content="nutrative" />
	<meta property="og:description" content="" />
	
	<title>Nutrative</title>
	
	<base href="<?=base_url();?>">
	<link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap-theme.min.css">
	<link type="text/css" rel="stylesheet" href="css/site/geral.css">
	<?=(isset($htmlCss) ? $htmlCss : '');?>
	
	<script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="vendor/jquery-maskmoney/src/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="js/geral.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<?=(isset($htmlJavaScript) ? $htmlJavaScript : '');?>
</head>

<body>
<header id="bgTopo" class="conteudo">
	<div class="container">
		<div class="left">
			<div class="logo">
				<img src="img/site/layout/logop.png" alt="">
			</div>
		</div>
		<div class="center">
			<div class="nav">
				<ul>
					<li><a href="<?=base_url();?>index.php/site/inicio">INICIO</a></li>
					<li><a href="<?=base_url();?>index.php/site/conheca">CONHEÇA</a></li>
					<li><a href="<?=base_url();?>index.php/site/planos">PLANOS</a></li>
					<li><a href="<?=base_url();?>index.php/site/contato">CONTATO</a></li>
				</ul>
			</div>
		</div>
		<div class="right"> 
			<div class="login">
				<a href="javascript: modalLogin();"><img src="img/site/layout/login.png" alt="" class="icon"></a>
				<div id="modLogin">
					<div class="modal-login">
						<div class="header">
							<p>Acessar sua conta</p>
							<a href="javascript: modalLogin();" class="btFechar">X</a>
						</div>
						<form action="<?=base_url();?>index.php/site/login/action" method="POST">
							<div class="input-login">
								<input type="text" name="login" id="login" placeholder="Login">
							</div>
							<div class="input-login">
								<input type="password" name="senha" id="senha" placeholder="Senha">
							</div>
							<button class="btPadrao2 laranja">Entrar</button>
							<a href="<?=base_url();?>index.php/site/cadastro" class="btPadrao2 cinza">Inscreva-se</a>
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
</header>
