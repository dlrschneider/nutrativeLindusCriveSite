<div id="containerConteudo" class="container">
	<?=tituloCadastro(($id == NULL ? 'Nova' : 'Alterar') . ' Dieta');?>
	<br /><br />
	<?=$msgErroForm;?>
	
	<ul class="nav nav-tabs">
	  <li aba="boxDieta"<?=(!$abaAlimento ? ' class="active"' : '');?>><a class="lnkAba">Dieta</a></li>
	  
	  <?php if ($diet->idDieta): ?>
	  <li aba="boxAlimentos"<?=($abaAlimento ? ' class="active"' : '');?>><a class="lnkAba">Alimentos</a></li>
	  <?php endif;?>
	</ul>
	
	<?=form_open(base_url() . $actionForm, array('id' => 'frmDiet', 'class' => 'form-horizontal'));?>
		<div class="well well-sm">
			<div<?=($abaAlimento ? ' style="display: none;"' : '');?> class="boxAba espacamento" id="boxDieta">
				<div class="form-group">
				   <label for="texTitulo" class="col-sm-2 control-label">Nome</label>
				   <div class="col-sm-5">
				   <input type="text" name="texNome" id="texNome" class="form-control" value="<?=$diet->nome;?>" required/>
				   </div>
				</div>
				
				<div class="form-group">
				   <label for="cmbAtivo" class="col-sm-2 control-label">Ativo</label>
				   <div class="col-sm-2">
					  <select class="form-control" name="cmbAtivo" id="cmbAtivo">
						  <option value="S"<?=($diet->ativo == 'S' ? " selected=\"selected\"" : '');?>>Sim</option>
						  <option value="N"<?=($diet->ativo == 'N' ? " selected=\"selected\"" : '');?>>Não</option>
					  </select>
				   </div>
				</div>
				
				<?php if ($diet->dataCadastro): ?>
				<div class="form-group">
				   <label class="col-sm-2 control-label">Data cadastro</label>
				   <div class="col-sm-2">
				   <input type="text" name="dataCad" id="dataCad" class="form-control" readonly="true" value="<?=formataDataHora($diet->dataCadastro);?>"></input>
				   <?=form_hidden('hidDataCadastro', $diet->dataCadastro);?>
				   </div>
				</div>
				<?php endif;?>
			</div>
			
			<?php if ($diet->idDieta): ?>
			<div<?=(!$abaAlimento ? ' style="display: none;"' : '');?> class="boxAba espacamento" id="boxAlimentos">
				<div class="col-sm-4">
					<input class="form-control" type="text" name="texBuscaAlimento" id="texBuscaAlimento" placeholder="Busca"/>
				</div>
				
				<br class="clear"/>
				
				<div id="boxEsquerda">
				</div>
				
				
				<div id="boxDireita">
					<?=$diet->htmlAlimentosVinculados;?>
				</div>
				
				<br class="clear"/>
			</div>
			<?php endif;?>
			
			<div class="form-group espacamento">
			   <div class="col-md-offset-10">
			      <?=botaoCancelar('nutri/diet');?> <?=botaoConfirmar();?>
			   </div>
			</div>
		</div>
	<?=form_close()?>
</div>
<script>
$(document).ready(function(){
   $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
   
	busca = false;
	$("#texBuscaAlimento").keyup(function(event) {
	   if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
       
	   if (!busca) {
   	   busca = true;
         
   	   $.ajax({
   	        url: "<?=base_url();?>index.php/nutri/diet/ajaxBuscaAlimento/<?=$diet->idDieta?>",
   			data: {busca: $("#texBuscaAlimento").val()},
   	        type: "POST",
   	        success: function(html) {
   				$('#boxEsquerda').html(html);
   	        }
   	   }).done(function(){
   		   busca = false;
   	   });
	   }
	});
	
	$(document).on('click', '.boxNaoVinculado', function(){
		var id = $(this).data('idalimento');
		var box = $(this);
		$.ajax({
	        url: "<?=base_url();?>index.php/nutri/diet/ajaxAdicionaAlimento/<?=$diet->idDieta?>",
			data: {idAlimento: id},
	        type: "POST",
	        success: function(html) {
		        if (html == 'ERRO') {
				   alert("*** ATENÇÃO ***\n\nOcorreu algum erro ao adicionar o alimento. Por favor, atualize a página e tente novamente");
			    } else {
				   $('#boxDireita').append($(html).hide().fadeIn(1000));
				   box.fadeOut(400, function() {
				      $(this).remove();
				   });
			    }
	        }
	   });
	});

   $(document).on('click', '.radTurno', function(){
      id = $(this).closest('.boxVinculado').data('iddieta_alimento');
      valor = $(this).val();

      $.ajax({
        url: "<?=base_url();?>index.php/nutri/diet/ajaxAtualizaTurno/",
        data: {iddieta_alimento: id, turno: valor},
        type: "POST"
      });
   });

   $(document).on('click', '.boxVinculado .boxInformacaoAlimento span', function(e){
      if (e.target !== this)
         return;

      div = $(this).closest('.boxVinculado');
      var id = div.data('iddieta_alimento');
      $.ajax({
           url: "<?=base_url();?>index.php/nutri/diet/ajaxRemoveAlimento/" + id,
           type: "POST"
      }).done(function( data ) {
         div.fadeOut(400, function() {
            div.remove();
         });
      });
    });
   
	$(document).on('click', '.boxVinculado', function(e){
	   if (e.target !== this)
	      return;
      
		var id = $(this).data('iddieta_alimento');
		var box = $(this);
		$.ajax({
	        url: "<?=base_url();?>index.php/nutri/diet/ajaxRemoveAlimento/" + id,
	        type: "POST"
	   }).done(function( data ) {
		   box.fadeOut(400, function() {
		      $(this).remove();
		   });
	   });
    });
});
</script>
