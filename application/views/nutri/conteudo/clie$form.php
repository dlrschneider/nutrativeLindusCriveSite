<div id="containerConteudo" class="container">

<?=tituloCadastro(($id == NULL ? 'Novo' : 'Alterar') . ' Cliente');?>
<br /><br />
<?=$msgErroForm;?>

<div class="well well-sm">
<?=form_open(base_url() . $actionForm, array('id' => 'frmClie', 'class' => 'form-horizontal'));?>

<div class="form-group">
   <label for="texNome" class="col-sm-2 control-label">Nome Completo</label>
   <div class="col-sm-5">
   <input type="text" name="texNome" id="texNome" class="form-control" value="<?=$clie->nome;?>" requireds/>
   </div>
</div>

<div class="form-group">
   <label for="texDataNascimento" class="col-sm-2 control-label">Data Nascimento</label>
   <div class="col-sm-2">
   <input type="text" name="texDataNascimento" id="texNome" class="form-control" value="<?=formataData($clie->dataNascimento);?>" requireds/>
   </div>
</div>

<div class="form-group">
   <label for="cmbAtivo" class="col-sm-2 control-label">Ativo</label>
   <div class="col-sm-2">
   <select class="form-control" name="cmbAtivo" id="cmbAtivo">
   <option value="S"<?=($clie->ativo == 'S' ? " selected=\"selected\"" : '');?>>Sim</option>
   <option value="N"<?=($clie->ativo == 'N' ? " selected=\"selected\"" : '');?>>Não</option>
   </select>
   </div>
</div>

<?php if ($clie->dataCadastro): ?>
<div class="form-group">
   <label class="col-sm-2 control-label">Data cadastro</label>
   <div class="col-sm-8">
   <?=formataDataHora($clie->dataCadastro);?>
   <?=form_hidden('hidDataCadastro', $clie->dataCadastro);?>
   </div>
</div>
<?php endif;?>


<div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
   <?=botaoConfirmar();?> <?=botaoCancelar('nutri/clie');?>
   </div>
</div>

<?=form_close()?>
</div>
</div>