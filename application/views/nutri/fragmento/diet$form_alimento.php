<div class="boxAlimento boxNaoVinculado" data-idalimento="<?=$alim->idAlimento;?>">
	<p><?=$alim->nome;?></p>
	<div class="boxInformacaoAlimento">
		<span>Carboidrato<br><?=formataValor($alim->carboidrato);?></span>
		<span>Prote�na<br><?=formataValor($alim->proteina);?></span>
		<span>Lip�dio<br><?=formataValor($alim->lipidio);?></span>
	</div>
</div>