<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	
	<ul class="nav nav-tabs">
	  <li aba="boxDieta" class="active"><a class="lnkAba">Dieta Ativa</a></li>
	  <li aba="boxHistorico"><a class="lnkAba">Histórico</a></li>
     <li aba="boxAlimentacao"><a class="lnkAba">Alimentação</a></li>
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
                     <th>Data Cadastro</th>
                  </tr>
               </thead>
               <tbody class="tbody">
               <?php foreach ($listaDihi as $dihi): ?>
                  <tr>
                     <td><a href="index.php/cliente/diet/detalhe/<?=$dihi->idDietaHistorico?>"><?=$dihi->dieta->nome;?></a></td>
                     <td><?=formataData($dihi->dataCadastro);?></td>
                  </tr>
               <?php endforeach;?>
               </tbody>
            </table>
            <?=avisoNenhumRegistroEncontrado(count($listaDihi));?>
         </div>
      </div>
      
      <div class="boxAba" id="boxAlimentacao" style="display: none;">
         <div id="boxCalendario"></div>
      </div>
   </div>
</div>

<script>
$(document).ready(function() {
	$('#boxCalendario').fullCalendar({
	   header: {
	        left: 'prev,next today',
	        center: 'title',
	        right: ''
	    },
	   dayClick: function() {
	        alert('a day has been clicked!');
	    }
	});
});
</script>