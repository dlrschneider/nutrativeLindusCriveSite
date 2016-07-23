<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	
	<ul class="nav nav-tabs">
     <li aba="boxAlimentacao" class="active"><a class="lnkAba">Alimentação</a></li>
	  <li aba="boxDieta"><a class="lnkAba">Dieta Ativa</a></li>
	  <li aba="boxHistorico"><a class="lnkAba">Histórico</a></li>
	</ul>
	
   <div class="well well-sm">
      <div class="boxAba" id="boxAlimentacao">
         <div id="boxCalendario"></div>
      </div>
      
      <div class="boxAba" id="boxDieta" style="display: none;">
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
   </div>
</div>

<div id="containerModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alimentação <span id="spnDataAlimentacao"></span></h4>
      </div>
      <div class="modal-body">
         <span id="spnAguarde">Salvando informações, aguarde...</span>
         <div class="boxFormNovo"></div>
         <div class="boxFormAlimentacao boxFormAdicionar">
            <input type="text" class="texAlimento form-control" readyonly/>
            <input type="text" class="texQuantidade form-control" readyonly/>
            <select class="cmbTurno form-control" readyonly>
               <option value="Manhã">Manhã</option>
               <option value="Almoço">Almoço</option>
               <option value="Lanche">Lanche</option>
               <option value="Noite">Noite</option>
            </select>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnFechar" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" id="btnSalvar" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
	$('#boxCalendario').fullCalendar({
	   theme: true,
	   monthNames: ['Janero','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
      monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
	   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
	   header: {
	        left: 'prev,next',
	        center: 'title',
	        right: ''
	   },
	   defaultDate: '<?=date('Y-m-d');?>',
	   dayClick: function(date) {
         $("#spnDataAlimentacao").html(date.format());

         $.ajax({
 	        url: "<?=base_url();?>index.php/cliente/diet/ajaxRecuperaAlimentos/" + date.format() + "/" + <?=$clie->idCliente;?> + "/" + <?=$dihiAtiva->idDietaHistorico;?>,
 	        success: function(html) {
     		    $('.boxFormNovo').html(html);
     		  $('.texQuantidade').maskMoney({thousands:'.', decimal:','});
 	        }
    	   });
      
         $('#containerModal').modal('show');
	    }
	});

   $('.boxFormAdicionar').click(function(){
      $.ajax({
	        url: "<?=base_url();?>index.php/cliente/diet/ajaxAddNovosCampos/",
	        success: function(html) {
   		    $('.boxFormNovo').append(html);
   		    $('.texQuantidade').maskMoney({thousands:'.', decimal:','});
   		    $('.boxFormNovo .texAlimento:last').focus();
	        }
  	   });
   });

   $(document).on('click', '.iconRemover', function(){
      divPai = $(this).parent('.boxFormAlimentacao');
      if (divPai.data('id')) {
         $.ajax({
           url: "<?=base_url();?>index.php/cliente/diet/ajaxRemoveAlimentacao/" + divPai.data('id')
         }).done(function(){
            divPai.remove();
         });
      } else {
         divPai.remove();
      }
   });

   $('#btnSalvar').click(function(){
      $("#spnAguarde").show();
      lista = [];
      $(".boxFormNovo .boxFormAlimentacao").each(function(){
         id = $(this).data('id');
         valAlimento = $(this).find('.texAlimento').val();
         valQuantidade = $(this).find('.texQuantidade').val();
         valTurno = $(this).find('.cmbTurno').val();

         arrHial = {idHial:id, alimento: valAlimento, quantidade: valQuantidade, turno: valTurno, data: $("#spnDataAlimentacao").html()};
         lista.push(arrHial);
      });
         
      $.ajax({
 	     url: "<?=base_url();?>index.php/cliente/diet/ajaxPersistencia/" + <?=$dihiAtiva->idDietaHistorico;?>,
 		  data: {listaHial: lista},
 	     type: "POST"
 	   }).done(function(){
         $("#spnAguarde").hide();
      });
   });
});
</script>