      <div class="boxAlimento">
         <p><?=$dial->alimento->nome;?></p>
         <div class="boxInformacaoAlimento">
             <span>Carboidrato<br><?=formataValor($dial->alimento->carboidrato);?></span>
             <span>Prote�na<br><?=formataValor($dial->alimento->proteina);?></span>
             <span>Lip�dio<br><?=formataValor($dial->alimento->lipidio);?></span>
         </div>
      </div>
s