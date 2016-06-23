<div id="containerConteudo" class="container">

<?=tituloCadastro(($id == NULL ? 'Nova' : 'Alterar') . ' Notícia');?>
<br /><br />
<?=$msgErroForm;?>

<div class="well well-sm">
<?=form_open_multipart(base_url() . $actionForm, array('id' => 'frmNutr', 'class' => 'form-horizontal'));?>

<div class="form-group">
   <label for="texNome" class="col-sm-2 control-label">Nome completo</label>
				    
	<div class="col-sm-4">
	   <input type="text" class="form-control" name="texNome" id="texNome" value="<?=$nutr->nome;?>" readonly>
	</div>
</div>
			   
<div class="form-group">
	<label for="texCnpj" class="col-sm-2 control-label">CNPJ</label>
				    
	<div class="col-sm-2">
	   <input type="text" class="form-control" name="texCnpj" id="texCnpj" value="<?=$nutr->cnpj;?>" readonly>
	</div>
</div>

<div class="form-group">
   <label for="texEmail" class="col-sm-2 control-label">Email</label>

   <div class="col-sm-4">
      <input type="text" class="form-control" name="texEmail" id="texEmail" value="<?=$nutr->email;?>" readonly>
   </div>
</div>

<div class="form-group">
   <label for="cmbEstado" class="col-sm-2 control-label">Cidade</label>
				    
	<div class="col-sm-3">
		<input type="text" class="form-control" name="texCidade" id="texCidade" value="<?=$nutr->cidade;?>" readonly>
	</div>
</div>
				
<div class="form-group">
	<label for="cmbEstado" class="col-sm-2 control-label">Estado</label>
				    
	<div class="col-sm-3">
		<?=comboEstado('cmbEstado', $nutr->estado, TRUE);?>
	</div>
</div>
				
<div class="form-group">
   <label for="texBairro" class="col-sm-2 control-label">Bairro</label>
				    
	<div class="col-sm-2">
	   <input type="text" class="form-control" name="texBairro" id="texBairro" value="<?=$nutr->bairro;?>" readonly>
	</div>
</div>
			   
<div class="form-group">
	<label for="texComplemento" class="col-sm-2 control-label">Complemento</label>
				    
	<div class="col-sm-5">
		<input type="text" class="form-control" name="texComplemento" id="texComplemento" value="<?=$nutr->complemento;?>" readonly>
	</div>
</div>
				
<div class="form-group">
	<label for="texLogin" class="col-sm-2 control-label">Login</label>
				    
	<div class="col-sm-3">
		<input type="text" class="form-control" name="texLogin" id="texLogin" value="<?=$nutr->login;?>" readonly>
	</div>
</div>

<div class="form-group">
     <label for="cmbAtivo" class="col-sm-2 control-label">Ativo</label>
     <div class="col-sm-2">
        <select class="form-control" name="cmbAtivo" id="cmbAtivo">
           <option value="S"<?=($nutr->ativo == 'S' ? " selected=\"selected\"" : '');?>>Sim</option>
           <option value="N"<?=($nutr->ativo == 'N' ? " selected=\"selected\"" : '');?>>Não</option>
    	</select>
	</div>
</div>
            
<?php if ($nutr->dataCadastro): ?>
<div class="form-group">
   <label class="col-sm-2 control-label">Data cadastro</label>
   <div class="col-sm-8">
   <?=formataDataHora($nutr->dataCadastro);?>
   <?=form_hidden('hidDataCadastro', $nutr->dataCadastro);?>
   </div>
</div>
<?php endif;?>


<div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
   <?=botaoConfirmar();?> <?=botaoCancelar('admin/nutr');?>
   </div>
</div>

<?=form_close()?>
</div>
</div>