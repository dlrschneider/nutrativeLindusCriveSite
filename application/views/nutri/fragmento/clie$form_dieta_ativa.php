      <div class="boxAlimento">
         <p><?=$dial->alimento->nome;?></p>
         <div class="boxInformacaoAlimento">
             <span>Carboidrato<br><?=formataValor($dial->alimento->carboidrato);?></span>
             <span>Proteína<br><?=formataValor($dial->alimento->proteina);?></span>
             <span>Lipídio<br><?=formataValor($dial->alimento->lipidio);?></span>
         </div>
      </div>
s