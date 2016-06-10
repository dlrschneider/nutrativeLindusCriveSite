<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	
	<ul class="nav nav-tabs">
	  <li aba="boxDieta" class="active"><a class="lnkAba">Dieta Ativa</a></li>
	  <li aba="boxHistorico"><a class="lnkAba">Histórico</a></li>
	</ul>
	
   <div class="well well-sm">
      <div class="boxAba" id="boxDieta">
         <?=$diet->htmlAlimentosVinculados;?>
      </div>
      
      <div class="boxAba" id="boxHistorico" style="display: none;">
         <div class="box">
            <table class="table">
               <thead class="thead">
                  <tr class="tr">
                     <th>Nome</th>
                     <th>Ativo</th>
                     <th>Data Cadastro</th>
                  </tr>
               </thead>
               <tbody class="tbody">
               <?php foreach ($listaDihi as $dihi): ?>
                  <tr>
                     <td><a href="index.php/nutri/diet/form/<?=$dihi->dieta->idDieta?>"><?=$dihi->dieta->nome;?></a></td>
                     <td><?=formataAtivo($dihi->dieta->ativo);?></td>
                     <td><?=formataData($dihi->dataCadastro);?></td>
                  </tr>
               <?php endforeach;?>
               </tbody>
            </table>
            <?=avisoNenhumRegistroEncontrado(count($listaDihi));?>
         </div>
      </div>
   </div>
</div>