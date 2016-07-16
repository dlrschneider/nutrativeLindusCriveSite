<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	
	<ul class="nav nav-tabs">
	  <li aba="boxDieta" class="active"><a class="lnkAba">Dieta Ativa</a></li>
	  <li aba="boxAlimentacao"><a class="lnkAba">Alimentação</a></li>
	</ul>
	
   <div class="well well-sm">
      <div class="boxAba" id="boxDieta">
         <?=$diet->htmlAlimentosVinculados;?>
      </div>
      
      <div class="boxAba" id="boxAlimentacao" style="display: none;">
      </div>
   </div>
   
   <div class="form-group espacamento">
     <div class="col-sm-10">
     	  <?=botaoCancelar('cliente/diet', 'Voltar');?>
     </div>
  </div>
</div>