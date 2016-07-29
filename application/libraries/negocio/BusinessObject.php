<?php
/**
 * Abstraзгo dos objetos de negуcio.
 */
abstract class BusinessObject {
   
   /**
    * Enter description here ...
    * @param $p
    */
   public function __get($p) {
      //throw new Exception("ERRO: a propriedade [$p] nao existe na classe [" . get_class($this). "]");
   }
   
   /**
    * Enter description here ...
    * @param $p
    * @param $valor
    */
   public function __set($p, $valor) {
      //throw new Exception("ERRO: a propriedade [$p] nao existe na classe [" . get_class($this). "]");
   }
}