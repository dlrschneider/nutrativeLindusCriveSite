<?php
/**
 * Gerenciador de Cadastros > Login
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Nutrative - Login</title>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/css/bootstrap-theme.min.css">
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/admin/geral.css">
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/admin/login.css">

<script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>vendor/jquery/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/geral.js"></script>
</head>

<body onload="document.frmLogin.login.focus();">

<div id="boxLogin" class="container">
<div class="panel panel-default">
  <div class="panel-heading">
  Login
  </div>
  <div class="panel-body">
  
  <?php
   if ($loginErro) {
      echo "<div class=\"alert alert-danger\">Acesso Negado</div>\n";
   }?>
   <form class="form-horizontal" method="post" name="frmLogin" action="<?=base_url();?>index.php/site/login/action">
   
   <div class="form-group">
      <label for="texRazaoSocial" class="col-sm-2 control-label">Usuário</label>
      <div class="col-sm-10">
      <?=form_input('login', NULL, 'id="login" class="form-control" style="text-transform: uppercase;"');?>
      </div>
   </div>
   
   <div class="form-group">
      <label for="texRazaoSocial" class="col-sm-2 control-label">Senha</label>
      <div class="col-sm-10">
      <?=form_password('senha', NULL, 'id="senha" class="form-control"');?>
      <input style="margin-top: 5px;" class="btn btn-default btn-sm" type="submit" name="enviar" id="enviar" value="Acessar &raquo;">
      </div>
   </div>
   
   </form>
  </div>
</div>
</div>

</body>
</html>