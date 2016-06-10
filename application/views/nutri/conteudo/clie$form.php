<div id="containerConteudo" class="container">
	<?=tituloCadastro(($id == NULL ? 'Novo' : 'Alterar') . ' Cliente');?>
	<br /><br />
	<?=$msgErroForm;?>
	
	
	<ul class="nav nav-tabs">
	  <li aba="boxCliente" class="active"><a class="lnkAba">Cliente</a></li>
	  
	  <?php if ($clie->idCliente): ?>
	  <li aba="boxDietas"><a class="lnkAba">Dieta</a></li>
     <li aba="boxHistorico"><a class="lnkAba">Histórico</a></li>
	  <li aba="boxAlimentacao"><a class="lnkAba">Alimentação</a></li>
	  <li aba="boxNotas"><a class="lnkAba">Anotações</a></li>
	  <?php endif;?>
	</ul>
	<?=form_open(base_url() . $actionForm, array('id' => 'frmClie', 'class' => 'form-horizontal'));?>
		<div class="well well-sm">
			<div class="boxAba" id="boxCliente">
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
				   <option value="N"<?=($clie->ativo == 'N' ? " selected=\"selected\"" : '');?>>Não</option>
				   </select>
				   </div>
				</div>
				
				<?php if ($clie->dataCadastro): ?>
				<div class="form-group">
				   <label class="col-sm-2 control-label">Data cadastro</label>
				   <div class="col-sm-8">
				   <?=formataDataHora($clie->dataCadastro);?>
				   <?=form_hidden('hidDataCadastro', $clie->dataCadastro);?>
				   </div>
				</div>
				<?php endif;?>
		    </div>
		    
		    <?php if ($clie->idCliente): ?>
		    <div style="display: none;" class="boxAba" id="boxDietas">
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
	                <button id="btnVinculaDieta" class="btn btn-primary" type="button">Vincular Dieta</button>
                </div>
             </div>
             
             <br class="clear">
             
             <div id="containerDietaAtiva">
                <?=($dietAtiva ? $dietAtiva->htmlAlimentosVinculados : '');?>
             </div>
             
             <br class="clear">
		    </div>
          
          <div style="display: none;" class="boxAba" id="boxHistorico">
             <?=subtituloCadastro("Histórico de dietas")?>
             
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
          
		    <div style="display: none;" class="boxAba" id="boxAlimentacao"></div>
		    <div style="display: none;" class="boxAba" id="boxNotas">
             <?=subtituloCadastro("Dúvidas do Paciente")?>
             
             <div class="box">
               <table class="table">
                  <thead class="thead">
                     <tr class="tr">
                        <th>Descrição</th>
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
        </div>
		
	   <div class="form-group">
	      <div class="col-sm-10">
             <?=botaoConfirmar();?> <?=botaoCancelar('nutri/clie');?>
		  </div>
	   </div>
	<?=form_close()?>
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
				   alert("*** ATENÇÃO ***\n\nOcorreu algum erro ao vincular a dieta. Por favor, atualize a página e tente novamente");
			    } else {
			      $("#containerDietaAtiva").html($(html).hide().fadeIn(1000));
			    }
	      }
	   });
   });
});
</script>