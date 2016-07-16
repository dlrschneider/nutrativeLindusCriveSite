<?php
/**
 * Exceções de modelos de dados, com geração automática de logs do tipo "error".
 */
class ModelException extends Exception {
   
   /**
    * @var string Número do erro da última query executada.
    */
   public $erroDatabaseNumero = NULL;
   
   /**
    * @var string Mensagem de erro da última query executada.
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
      
      // RS 16/03/2015: grava as informações do erro antes de gravar log para não perder a mensagem de erro.
      $this->erroDatabaseNumero = $CI->db->conn_id->errno;
      $this->erroDatabaseMensagem = $CI->db->conn_id->error;
   }

   /**
    * Retorna mensagem de erro a ser apresentada para o usuário
    */
   public function erroDatabase() {
      return $this->erroDatabaseNumero . ' - ' . $this->erroDatabaseMensagem;
   }
}