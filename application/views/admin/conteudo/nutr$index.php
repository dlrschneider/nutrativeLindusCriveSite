<script type="text/javascript">
function excluiNutr(id) {
   if (confirm("<?=MensagemSite::JS_EXCLUSAO_REGISTROS;?>")) {
      window.location.href = "<?=site_url() . '/admin/nutr/exclui/';?>" + id;
   }
}
</script>
<div id="containerConteudo" class="container">
	<div class="conteudoListagem">
		<div class="title">
			<h2><?=tituloCadastro('Nutricionistas', $listaNutr_qtdeReg);?></h2>
		</div>
		<div class="box">
			<?=$msgExclusao;?>
			<table class="table">
				<thead class="thead">
					<tr class="tr">
		                <th>Nome</th>
                        <th>Ativo</th>
						<th>Data Cadastro</th>
						<th>Excluir</th>
					</tr>
				</thead>
				<tbody class="tbody">
				<?php $lin = 0; 
					  foreach ($listaNutr as $nutr): ?>
					<tr <?=($lin++ % 2 == 0 ? 'style="background-color: #EEE;"' : '');?>>
						<td><a href="index.php/admin/nutr/form/<?=$nutr->idNutricionista;?>"><?=$nutr->nome;?></a></td>
                        <td><?=formataAtivo($nutr->ativo);?></td>
						<td><?=formataData($nutr->dataCadastro);?></td>
						<td><a href="javascript: excluiNutr(<?=$nutr->idNutricionista?>);"><img src="img/nutri/layout/garbage.png" ></a></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<?=avisoNenhumRegistroEncontrado($listaNutr_qtdeReg);?>
		</div>
	</div>
</div>