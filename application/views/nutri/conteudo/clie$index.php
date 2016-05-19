<script type="text/javascript">
function excluiClie(id) {
   if (confirm("<?=MensagemSite::JS_EXCLUSAO_REGISTROS;?>")) {
      window.location.href = "<?=site_url() . '/nutri/clie/exclui/';?>" + id;
   }
}
</script>
<div id="containerConteudo" class="container">
	<div class="clientes">
		<div class="title">
			<h2><?=tituloCadastro('Clientes', $listaClie_qtdeReg);?></h2>
		</div>
		<div class="box">
			<table class="table">
				<thead class="thead">
					<tr class="tr">
						<th class="hidden-phone" style="width:30px;">
							<input type="checkbox" onclick="seleciona_todos()" id="checkboxCheckAll">
						</th>
		                <th class="hidden-phone">ID</th>
		                <th style="width:90px;">Ações</th>
		                <th>Nome</th>
						<th class="hidden-phone">Data de nascimento</th>
					</tr>
				</thead>
				<tbody class="tbody">
					<tr>
						<td></td>
						<td>
							<div class="actions">
								<a href=""><img src="garbage.png"></a>
								<a href=""><img src="pencil.png"></a>
							</div>
						</td>
						<td>Alessandra Petry</td>
						<td>18/01/1996</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- 
<p class="linkCadastro"><?=botaoLocation('btNovoRegistro', 'Novo cliente', 'nutri/clie/form');?></p>
<?=$msgExclusao;?>
<?php
$lin = 1;

foreach ($listaClie as $clie) {
   echo "<tr class=\"" . ($lin++ % 2 == 0 ? 'l1' : 'l2') . "\">\n"
   . "<td><a href=\"index.php/nutri/clie/form/{$clie->idCliente}\">{$clie->nome}</a></td>\n"
   . "<td>" . formataAtivo($clie->ativo) . "</td>\n"
   . '<td>' . formataDataHora($clie->dataCadastro) . "</td>\n"
   . "<td class=\"tdExc\"><a href=\"javascript: excluiClie({$clie->idCliente});\">[ X ]</a></td>\n"
   . "</tr>\n";
}?>
</table>
<?=avisoNenhumRegistroEncontrado($listaClie_qtdeReg);?>
</div> -->