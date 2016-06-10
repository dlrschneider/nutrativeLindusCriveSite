<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	<?=$msgErroForm;?>
	
	<ul class="nav nav-tabs">
	  <li aba="boxDieta" class="active"><a class="lnkAba">Dieta Ativa</a></li>
	  <li aba="boxHistorico"><a class="lnkAba">Histórico</a></li>
	</ul>
	
   <div class="well well-sm">
      <div class="boxAba" id="boxDieta">
      </div>
      
      <div class="boxAba" id="boxHistorico">
      </div>
   </div>
</div>