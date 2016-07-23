<div id="containerConteudo" class="container">
	<?=tituloCadastro('Dietas');?>
	<br /><br />
	
	<ul class="nav nav-tabs">
	  <li aba="boxAlimentacao" class="active"><a class="lnkAba">Alimenta��o</a></li>
	  <li aba="boxDieta"><a class="lnkAba">Dieta Ativa</a></li>
	</ul>
	
   <div class="well well-sm">
      <div class="boxAba" id="boxAlimentacao">
         <div id="boxCalendario"></div>
      </div>
      
      <div class="boxAba" id="boxDieta" style="display: none;">
         <?=$diet->htmlAlimentosVinculados;?>
      </div>
   </div>
   
   <div class="form-group espacamento">
     <div class="col-sm-10">
     	  <?=botaoCancelar('nutri/clie/form/' . $clie->idCliente, 'Voltar');?>
     </div>
  </div>
</div>

<div id="containerModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alimenta��o <span id="spnDataAlimentacao"></span></h4>
      </div>
      <div class="modal-body">
         <div class="boxFormNovo"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnFechar" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
   $('#boxCalendario').fullCalendar({
      theme: true,
      monthNames: ['Janero','Fevereiro','Mar�o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
      monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      dayNames: ['Domingo', 'Segunda', 'Ter�a', 'Quarta', 'Quinta', 'Sexta', 'S�bado'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S�b'],
      header: {
           left: 'prev,next',
           center: 'title',
           right: ''
      },
      defaultDate: '<?=date('Y-m-d');?>',
      dayClick: function(date) {
         $("#spnDataAlimentacao").html(date.format());

         $.ajax({
           url: "<?=base_url();?>index.php/nutri/clie/ajaxRecuperaAlimentos/" + date.format() + "/" + <?=$clie->idCliente;?> + "/" + <?=$dihi->idDietaHistorico;?>,
           success: function(html) {
             $('.boxFormNovo').html(html);
             $('.texQuantidade').maskMoney({thousands:'.', decimal:','});
           }
         });
      
         $('#containerModal').modal('show');
       }
   });
});
</script>