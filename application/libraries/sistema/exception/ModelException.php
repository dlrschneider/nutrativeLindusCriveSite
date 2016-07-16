<?php
/**
 * Exce��es de modelos de dados, com gera��o autom�tica de logs do tipo "error".
 */
class ModelException extends Exception {
   
   /**
    * @var string N�mero do erro da �ltima query executada.
    */
   public $erroDatabaseNumero = NULL;
   
   /**
    * @var string Mensagem de erro da �ltima query executada.
    */
   public $erroDatabaseMensagem = NULL;
   
   /**
    * Construtor.
    * @param string $descricao
    * @version 1.0.0
    * @return void
    */
   public function __construct($descricao) {
      parent::__construct($descricao);
      $CI = &get_instance();
      log_message('error', "ModelException: {$descricao}");
      
      // RS 16/03/2015: grava as informa��es do erro antes de gravar log para n�o perder a mensagem de erro.
      $this->erroDatabaseNumero = $CI->db->conn_id->errno;
      $this->erroDatabaseMensagem = $CI->db->conn_id->error;
   }

   /**
    * Retorna mensagem de erro a ser apresentada para o usu�rio
    */
   public function erroDatabase() {
      return $this->erroDatabaseNumero . ' - ' . $this->erroDatabaseMensagem;
   }
}