<?php
/**
 * Controle do cadastro básico de anotações do cliente.
 */
class Anot extends MY_Controller {
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();
   }

   /**
    * Processa inclusão de anotações
    * @return void
    */
   public function ajaxAdicionaAnotacao() {
      if (!$this->input->post('mensagem')) {
         return;
      }
      
      $anot = new Anotacao();
      $anot->cliente = $this->session->userdata('CLIE_login');
      $anot->descricao = utf8_decode($this->input->post('mensagem'));
      $anot->dataCadastro = date('Y-m-d H:i:s');
      
      try {
         $this->anotModel->grava($anot);
         echo "<p>{$anot->descricao}</p>";
      } catch(Exception $e) {
         log_message("error", "Erro ao incluír anotação do cliente");
         return;
      }
   }
}