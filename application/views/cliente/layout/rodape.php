<div class="container">
	<footer class="footer" style="color: gray">
		<div class="">
			
		</div>		
	</footer>
</div>

<div id="containerGeralAnot">
   <div id="boxTituloAnot"><span id="spnTitulo">Anotações</span> <span id="spnIcone" class="glyphicon glyphicon-minus"></span></div>
   
   <div id="containerConteudoAnot">
      <div id="boxConteudoAnot">
         <?php 
            foreach($listaAnot as $anot) {
               echo "<p>{$anot->descricao}</p>";
            }
         ?>
      </div>
      <input type="text" id="texAddMensagem" name="texAddMensagem"/>
   </div>
</div>

<script>
$(document).ready(function(){
   fechado = true;
   $("#boxTituloAnot").click(function(){
      if (fechado) {
         fechado = false;
         $("#containerGeralAnot").css('margin-top', '-370px');
         $("#containerConteudoAnot").show();
      } else {
         fechado = true;
         $("#containerGeralAnot").css('margin-top', '-40px');
         $("#containerConteudoAnot").hide();
      }
   });

   $("#texAddMensagem").keypress(function(e){
      if (e.which == 13) {
         $.ajax({
 	        url: "<?=base_url();?>index.php/cliente/anot/ajaxAdicionaAnotacao/",
 			  data: {mensagem: $("#texAddMensagem").val()},
 	        type: "POST",
 	        success: function(html) {
 		        $("#boxConteudoAnot").append(html);
 		        $("#texAddMensagem").val('');
 			  }
 	      });
 	   }
   });
});
</script>

</body>
</html>