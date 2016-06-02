<script type="text/javascript">
function excluiClie(id) {
   if (confirm("<?=MensagemSite::JS_EXCLUSAO_REGISTROS;?>")) {
      window.location.href = "<?=site_url() . '/nutri/clie/exclui/';?>" + id;
   }
}
</script>
<div id="containerConteudo" class="container">
	<div class="conteudoListagem">
		<div class="title">
			<h2><?=tituloCadastro('Clientes', $listaClie_qtdeReg);?></h2>
			<p class="linkCadastro"><?=botaoLocation('btNovoRegistro', 'Novo cliente', 'nutri/clie/form');?></p>
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
				<?php foreach ($listaClie as $clie): ?>
					<tr>
						<td><a href="index.php/nutri/clie/form/<?=$clie->idCliente?>"><?=$clie->nome;?></a></td>
						<td><?=formataAtivo($clie->ativo);?></td>
						<td><?=formataData($clie->dataCadastro);?></td>
						<td class="tdExc"><a href="javascript: excluiClie(<?=$clie->idCliente?>);">[ X ]</a></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<?=avisoNenhumRegistroEncontrado($listaClie_qtdeReg);?>
		</div>
	</div>
</div>