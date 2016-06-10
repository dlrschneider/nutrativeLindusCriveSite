<script type="text/javascript">
function excluiNoti(id) {
   if (confirm("<?=MensagemSite::JS_EXCLUSAO_REGISTROS;?>")) {
      window.location.href = "<?=site_url() . '/nutri/noti/exclui/';?>" + id;
   }
}
</script>
<div id="containerConteudo" class="container">
	<div class="conteudoListagem">
		<div class="title">
			<h2><?=tituloCadastro('Noticias', $listaNoti_qtdeReg);?></h2>
			<p class="linkCadastro"><?=botaoLocation('btNovoRegistro', 'Nova notícia', 'nutri/noti/form');?></p>
		</div>
		<div class="box">
			<?=$msgExclusao;?>
			<table class="table">
				<thead class="thead">
					<tr class="tr">
		                <th>Título</th>
						<th>Data Cadastro</th>
						<th>Excluir</th>
					</tr>
				</thead>
				<tbody class="tbody">
				<?php $lin = 0; 
					  foreach ($listaNoti as $noti): ?>
					<tr <?=($lin++ % 2 == 0 ? 'style="background-color: #EEE;"' : '');?>>
						<td><a href="index.php/nutri/noti/form/<?=$noti->idNoticia?>"><?=$noti->titulo;?></a></td>
						<td><?=formataData($noti->dataCadastro);?></td>
						<td><a href="javascript: excluiNoti(<?=$noti->idNoticia?>);"><img src="img/nutri/layout/garbage.png" ></a></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<?=avisoNenhumRegistroEncontrado($listaNoti_qtdeReg);?>
		</div>
	</div>
</div>