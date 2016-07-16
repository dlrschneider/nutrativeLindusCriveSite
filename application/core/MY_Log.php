<?php
/**
 * Configura��o de logs de usu�rio, n�vel "0", que devem ser gerados sempre, independente do n�vel de erros.
 */
class MY_Log extends CI_Log {
   
   /**
    * Construtor.
    * @version 1.0.0
    * @return void
    */
   public function __construct() {
      // RS 29/01/2015: cria o n�vel "0-USER" antes de chamar o construtor-pai.
      $this->_levels = array('USER' => 0, 'ERROR' => 1, 'DEBUG' => 2,  'INFO' => 3, 'ALL' => 4);
      parent::__construct();
   }
}