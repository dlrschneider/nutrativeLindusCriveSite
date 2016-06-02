<script type="text/javascript">
function excluiDiet(id) {
   if (confirm("<?=MensagemSite::JS_EXCLUSAO_REGISTROS;?>")) {
      window.location.href = "<?=site_url() . '/nutri/diet/exclui/';?>" + id;
   }
}
</script>
<div id="containerConteudo" class="container">
	<div class="conteudoListagem">
		<div class="title">
			<h2><?=tituloCadastro('Dietas', $listaDiet_qtdeReg);?></h2>
			<p class="linkCadastro"><?=botaoLocation('btNovoRegistro', 'Nova dieta', 'nutri/diet/form');?></p>
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
				<?php foreach ($listaDiet as $diet): ?>
					<tr>
						<td><a href="index.php/nutri/diet/form/<?=$diet->idDieta?>"><?=$diet->nome;?></a></td>
						<td><?=formataAtivo($diet->ativo);?></td>
						<td><?=formataData($diet->dataCadastro);?></td>
						<td class="tdExc"><a href="javascript: excluiDiet(<?=$diet->idDieta?>);">[ X ]</a></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<?=avisoNenhumRegistroEncontrado($listaDiet_qtdeReg);?>
		</div>
	</div>
</div>