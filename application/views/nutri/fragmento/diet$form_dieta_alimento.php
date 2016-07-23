<?php 
$rand = rand(1, 999999);
?>
<div class="boxAlimento boxVinculado" data-iddieta_alimento="<?=$dial->idDietaAlimento;?>">
	<p><?=$dial->alimento->nome;?></p>
	<div class="boxInformacaoAlimento">
      <label title="Manh�"><input  type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Manh�" <?=(!$dial->turno || $dial->turno == "Manh�" ? "checked=\"checked\"" : "");?>/> M</label>
      <label title="Almo�o"><input type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Almo�o" <?=($dial->turno == "Almo�o" ? "checked=\"checked\"" : "");?>/> A</label>
      <label title="Lanche"><input type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Lanche" <?=($dial->turno == "Lanche" ? "checked=\"checked\"" : "");?>/> L</label>
      <label title="Janta"><input  type="radio" class="radTurno" name="radTurno<?=$rand;?>" value="Janta" <?=($dial->turno == "Janta" ? "checked=\"checked\"" : "");?>/> J</label>
		<span>Carboidrato<br><?=formataValor($dial->alimento->carboidrato);?></span>
		<span>Prote�na<br><?=formataValor($dial->alimento->proteina);?></span>
		<span>Lip�dio<br><?=formataValor($dial->alimento->lipidio);?></span>
	</div>
</div>