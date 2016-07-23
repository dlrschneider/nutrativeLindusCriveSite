<?php 
$rand = rand(1, 999999);
?>
<div class="boxAlimento boxVinculado" data-iddieta_alimento="<?=$dial->idDietaAlimento;?>">
	<p><?=$dial->alimento->nome;?></p>
	<div class="boxInformacaoAlimento">
      <label title="Manhã"><input  type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Manhã" <?=(!$dial->turno || $dial->turno == "Manhã" ? "checked=\"checked\"" : "");?>/> M</label>
      <label title="Almoço"><input type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Almoço" <?=($dial->turno == "Almoço" ? "checked=\"checked\"" : "");?>/> A</label>
      <label title="Lanche"><input type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Lanche" <?=($dial->turno == "Lanche" ? "checked=\"checked\"" : "");?>/> L</label>
      <label title="Janta"><input  type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Janta" <?=($dial->turno == "Janta" ? "checked=\"checked\"" : "");?>/> J</label>
		<span>Carboidrato<br><?=formataValor($dial->alimento->carboidrato);?></span>
		<span>Proteína<br><?=formataValor($dial->alimento->proteina);?></span>
		<span>Lipídio<br><?=formataValor($dial->alimento->lipidio);?></span>
	</div>
</div>