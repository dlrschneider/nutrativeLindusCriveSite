<div id="containerConteudo" class="container">
	<?=tituloCadastro('�ltimas Not�cias');?>
	<br /><br />
   
   <?php foreach($listaNoti as $noti):?>
   
   <div class="containerNoticias">
      <h2><?=$noti->titulo;?></h2>
      <?=$noti->imagem ? "<img src=\"img/user/noti/{$noti->imagem}\" />" : ""?>
      
      <div class="boxDescricao">
         <?=$noti->descricao;?>
      </div>
   </div>
   
   <?php endforeach;?>
   
</div>