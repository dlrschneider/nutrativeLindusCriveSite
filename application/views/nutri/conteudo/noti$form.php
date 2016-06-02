<div id="containerConteudo" class="container">

<?=tituloCadastro(($id == NULL ? 'Nova' : 'Alterar') . ' Not�cia');?>
<br /><br />
<?=$msgErroForm;?>

<div class="well well-sm">
<?=form_open_multipart(base_url() . $actionForm, array('id' => 'frmNoti', 'class' => 'form-horizontal'));?>

<div class="form-group">
   <label for="texTitulo" class="col-sm-2 control-label">T�tulo</label>
   <div class="col-sm-5">
   <input type="text" name="texTitulo" id="texTitulo" class="form-control" value="<?=$noti->titulo;?>" required/>
   </div>
</div>

<div class="form-group">
   <label for="memDescricao" class="col-sm-2 control-label">Descri��o</label>
   <div class="col-sm-7">
   <textarea name="memDescricao" id="memDescricao" class="form-control" rows="12" required><?=$noti->descricao;?></textarea>
   </div>
</div>

<div class="form-group">
   <label for="memDescricao" class="col-sm-2 control-label">Imagem</label>
   <div class="col-sm-7">
   <input type="file" id="updImagem" name="updImagem"/>
   </div>
</div>

<?php if ($noti->imagem):?>
<div class="form-group">
   <div id="boxApresentacaoImagens" class="col-sm-offset-2 col-sm-7">
   <img style="max-width: 300px; max-height: 300px;" src="<?=base_url();?>img/user/noti/<?=$noti->imagem;?>">
   </div>
</div>
<input type="hidden" id="hidImagem" name="hidImagem" value="<?=$noti->imagem;?>"/>
<?php endif;?>

<?php if ($noti->dataCadastro): ?>
<div class="form-group">
   <label class="col-sm-2 control-label">Data cadastro</label>
   <div class="col-sm-8">
   <?=formataDataHora($noti->dataCadastro);?>
   <?=form_hidden('hidDataCadastro', $noti->dataCadastro);?>
   </div>
</div>
<?php endif;?>


<div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
   <?=botaoConfirmar();?> <?=botaoCancelar('nutri/noti');?>
   </div>
</div>

<?=form_close()?>
</div>
</div>