<div id="containerConteudo" class="container">
	<?=tituloCadastro(($id == NULL ? 'Novo' : 'Alterar') . ' Cliente');?>
	<br /><br />
	<?=$msgErroForm;?>
	
	
	<ul class="nav nav-tabs">
	  <li aba="boxCliente" class="active"><a class="lnkAba">Cliente</a></li>
	  
	  <?php if ($clie->idCliente): ?>
	  <li aba="boxDietas"><a class="lnkAba">Dieta</a></li>
     <li aba="boxHistorico"><a class="lnkAba">Hist�rico</a></li>
	  <li aba="boxAlimentacao" id="liAlimentacao"><a class="lnkAba">Alimenta��o</a></li>
	  <li aba="boxNotas"><a class="lnkAba">Anota��es</a></li>
	  <?php endif;?>
	</ul>
	<?=form_open(base_url() . $actionForm, array('id' => 'frmClie', 'class' => 'form-horizontal'));?>
		<div class="well well-sm">
			<div class="boxAba espacamento" id="boxCliente">
				<div class="form-group">
				   <label for="texNome" class="col-sm-2 control-label">Nome Completo</label>
				   <div class="col-sm-5">
				   <input type="text" name="texNome" id="texNome" class="form-control" value="<?=$clie->nome;?>" requireds/>
				   </div>
				</div>
				
				<div class="form-group">
				   <label for="texDataNascimento" class="col-sm-2 control-label">Data Nascimento</label>
				   <div class="col-sm-2">
				   <input type="text" name="texDataNascimento" id="texDataNascimento" class="form-control" value="<?=formataData($clie->dataNascimento);?>" requireds/>
				   </div>
				</div>
				
	            <div class="form-group">
	               <label for="texAltura" class="col-sm-2 control-label">Altura</label>
	               <div class="col-sm-2">
	               <input type="text" name="texAltura" id="texAltura" class="form-control" value="<?=formataValor($clie->altura);?>"/>
	               </div>
	            </div>
	            
	            <div class="form-group">
	               <label for="texPeso" class="col-sm-2 control-label">Peso</label>
	               <div class="col-sm-2">
	               <input type="text" name="texPeso" id="texPeso" class="form-control" value="<?=formataValor($clie->peso);?>"/>
	               </div>
	            </div>
            
               <div class="form-group">
                  <label for="texLogin" class="col-sm-2 control-label">Login</label>
                  <div class="col-sm-2">
                  <input type="text" name="texLogin" id="texLogin" class="form-control" value="<?=$clie->login;?>" requered/>
                  </div>
               </div>
               
               <div class="form-group">
                  <label for="pwdSenha" class="col-sm-2 control-label">Senha</label>
                  <div class="col-sm-2">
                  <input type="password" name="pwdSenha" id="pwdSenha" class="form-control" value="<?=$clie->senha;?>"/>
                  </div>
               </div>
               
				<div class="form-group">
				   <label for="cmbAtivo" class="col-sm-2 control-label">Ativo</label>
				   <div class="col-sm-2">
				   <select class="form-control" name="cmbAtivo" id="cmbAtivo">
				   <option value="S"<?=($clie->ativo == 'S' ? " selected=\"selected\"" : '');?>>Sim</option>
				   <option value="N"<?=($clie->ativo == 'N' ? " selected=\"selected\"" : '');?>>N�o</option>
				   </select>
				   </div>
				</div>
				
				<?php if ($clie->dataCadastro): ?>
				<div class="form-group">
				   <label class="col-sm-2 control-label">Data cadastro</label>
				   <div class="col-sm-2">
				   <input type="text" name="dataCad" id="dataCad" class="form-control" readonly="true" value="<?=formataDataHora($clie->dataCadastro);?>"></input>
				   <?=form_hidden('hidDataCadastro', $clie->dataCadastro);?>
				   </div>
				</div>
				<?php endif;?>
		    </div>
		    
		    <?php if ($clie->idCliente): ?>
		    <div style="display: none;" class="boxAba espacamento" id="boxDietas">
             <div class="col-sm-9">
                <div class="boxLabelDietaAtiva col-sm-1">
                   <label class="lblDieta" for="cmbDieta">Dieta Ativa</label>
                </div>
                   
                <div class="col-sm-5">
		             <select id="cmbDieta" name="cmbDieta" class="form-control">
		                <option value="0">Selecione</option>
		                <?php foreach($listaDiet as $diet): ?>
		                   <option value="<?=$diet->idDieta?>"><?=$diet->nome;?></option>
		                <?php endforeach;?>
		             </select>
                </div>
                
                <div class="col-sm-5">
	                <button id="btnVinculaDieta" class="btn btn-warning" type="button">Vincular Dieta</button>
                </div>
             </div>
             
             <br class="clear">
             
             <div id="containerDietaAtiva">
                <?=($dietAtiva ? $dietAtiva->htmlAlimentosVinculados : '');?>
             </div>
             
             <br class="clear">
		    </div>
          
          <div style="display: none;" class="boxAba espacamento" id="boxHistorico">
             <?=subtituloCadastro("Hist�rico de dietas")?>
             
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
		                  <td><a href="index.php/nutri/clie/detalheHistorico/<?=$clie->idCliente?>/<?=$dihi->idDietaHistorico;?>"><?=$dihi->dieta->nome;?></a></td>
		                  <td><?=formataAtivo($dihi->dieta->ativo);?></td>
		                  <td><?=formataData($dihi->dataCadastro);?></td>
		               </tr>
		            <?php endforeach;?>
		            </tbody>
		         </table>
		         <?=avisoNenhumRegistroEncontrado(count($listaDihi));?>
		      </div>
          </div>
          
		    <div style="display: none;" class="boxAba espacamento" id="boxAlimentacao">
            <div id="boxCalendario"></div>
          </div>
          
		    <div style="display: none;" class="boxAba espacamento" id="boxNotas">
             <?=subtituloCadastro("D�vidas do Paciente")?>
             
             <div class="box">
               <table class="table">
                  <thead class="thead">
                     <tr class="tr">
                        <th>Descri��o</th>
                        <th style="width: 120px;">Data Cadastro</th>
                     </tr>
                  </thead>
                  <tbody class="tbody">
                  <?php foreach ($listaAnot as $anot): ?>
                     <tr>
                        <td><?=$anot->descricao?></td>
                        <td><?=formataData($anot->dataCadastro);?></td>
                     </tr>
                  <?php endforeach;?>
                  </tbody>
               </table>
               <?=avisoNenhumRegistroEncontrado(count($listaAnot));?>
            </div>
          </div>
		    <?php endif;?>
           <div class="form-group espacamento">
              <div class="col-md-offset-10">
                 <?=botaoCancelar('nutri/clie');?> <?=botaoConfirmar();?>
              </div>
           </div>
        </div>
	<?=form_close()?>
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
$(document).ready(function(){
	$("#texDataNascimento").mask('99/99/9999');

   $("#btnVinculaDieta").click(function(){
      $.ajax({
	      url: "<?=base_url();?>index.php/nutri/clie/ajaxVinculaDieta/<?=$clie->idCliente?>/" + $("#cmbDieta").val(),
	      type: "GET",
	      success: function(html) {
	         if (html == 'ERRO') {
				   alert("*** ATEN��O ***\n\nOcorreu algum erro ao vincular a dieta. Por favor, atualize a p�gina e tente novamente");
			    } else {
			      $("#containerDietaAtiva").html($(html).hide().fadeIn(1000));
			    }
	      }
	   });
   });

   $("#liAlimentacao").click(function(){
      <?php if ($dihiAtiva->idDietaHistorico): ?>
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
              url: "<?=base_url();?>index.php/nutri/clie/ajaxRecuperaAlimentos/" + date.format() + "/" + <?=$dihiAtiva->idDietaHistorico;?>,
              success: function(html) {
                $('.boxFormNovo').html(html);
                $('.texQuantidade').maskMoney({thousands:'.', decimal:','});
              }
            });
         
            $('#containerModal').modal('show');
          }
      });
      <?php endif;?>
   });
});
</script>
