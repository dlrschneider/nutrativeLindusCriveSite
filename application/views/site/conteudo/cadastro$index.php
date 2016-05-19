	<main role="main">
		<section id="bgMain">
			<div class="nutrition">
				<img src="img/site/layout/banner1.png" alt="">
			</div>
		</section>
		<section id="conteudoSite" class="container">
			<div class="page-header">
				<h1>Cadastre-se</h1>
			</div>
			<?=$retForm;?>
			<form class="form-horizontal" id="frmCadastro" method="post" action="<?=base_url();?>index.php/site/cadastro/action">
				<div class="form-group">
				   <label for="texNome" class="col-sm-2 control-label">Nome completo</label>
				    
				    <div class="col-sm-4">
				    <input type="text" class="form-control" name="texNome" id="texNome">
				    </div>
			   </div>
			   
			   <div class="form-group">
				   <label for="texCnpj" class="col-sm-2 control-label">CNPJ</label>
				    
				    <div class="col-sm-2">
				    <input type="text" class="form-control" name="texCnpj" id="texCnpj">
				    </div>
				</div>
				
			    <div class="form-group">
				   <label for="texEmail" class="col-sm-2 control-label">Email</label>
				    
				    <div class="col-sm-4">
				    <input type="text" class="form-control" name="texEmail" id="texEmail">
				    </div>
			   </div>
			   
			   <div class="form-group">
				   <label for="cmbEstado" class="col-sm-2 control-label">Cidade</label>
				    
				    <div class="col-sm-3">
				    <input type="text" class="form-control" name="texCidade" id="texCidade">
				    </div>
				</div>
				
			   <div class="form-group">
				   <label for="cmbEstado" class="col-sm-2 control-label">Estado</label>
				    
				    <div class="col-sm-3">
				    <?=comboEstado('cmbEstado', NULL);?>
				    </div>
				</div>
				
			    <div class="form-group">
				   <label for="texBairro" class="col-sm-2 control-label">Bairro</label>
				    
				    <div class="col-sm-2">
				    <input type="text" class="form-control" name="texBairro" id="texBairro">
				    </div>
			   </div>
			   
			   <div class="form-group">
				   <label for="texComplemento" class="col-sm-2 control-label">Complemento</label>
				    
				    <div class="col-sm-5">
				    <input type="text" class="form-control" name="texComplemento" id="texComplemento">
				    </div>
				</div>
				
			    <div class="form-group">
				   <label for="texLogin" class="col-sm-2 control-label">Login</label>
				    
				    <div class="col-sm-3">
				    <input type="text" class="form-control" name="texLogin" id="texLogin">
				    </div>
			   </div>
			   
			   <div class="form-group">
				   <label for="pwdSenhaCadastro" class="col-sm-2 control-label">Senha</label>
				    
				    <div class="col-sm-2">
				    <input type="password" class="form-control" name="pwdSenhaCadastro" id="pwdSenhaCadastro">
				    </div>
				</div>
				
				<button class="btn btn-success col-sm-offset-2">Cadastrar</button>
			</form>
		</section>
	</main>
</div>