<?php
/**
 * Integração das informações do site para o app
 */
class App2site extends MY_Controller {
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();
   }
   
   /**
    * Insere no banco as informações do histórico de alimentação enviadas a partir do app 
    */
   public function historicoAlimentacao() {
      $listaObj = json_decode($this->input->post('JSON_alimentacao'));
      
      // PEGAR CLIENTE
      // $idCliente
      
      try {
         $this->hialModel->limpaTabela();
      } catch (Exception $e) {
         log_message('info', "[WS] Limpesa da tabela historico_alimentacao para o cliente \"{$idCliente}\"");
      }
      
      foreach ($listaObj as $obj) {
         // Criar objeto historicoAlimentacao a partir do JSON
         // Gravar as informações
      }
   }

   /**
    * Insere no banco as anotações feitas no app pelo cliente
    */
   public function notas() {
      $listaObj = json_decode($this->input->post('JSON_notas'));
      
      // limpar anotações do cliente
      foreach ($listaObj as $obj) {
         // Criar objeto Anotacao a partir do JSON
         // Gravar as informações
      }
   }
   
   /**
    * WS para login a partir do app mobile, em caso de sucesso retorna uma string JSON para o app
    */
   public function login($idCliente) {
      try {
         $origLogin = $this->input->post('login');
         $origSenha = $this->input->post('senha');
         
         $login = mb_strtolower(addslashes(substr(trim($origLogin), 0, 20)));
         $senha = mb_strtolower(addslashes(substr(trim($origSenha), 0, 50)));
         
         $clie = $this->clieModel->carregaClienteLogin($login, $senha);
      } catch (Exception $e) {
         log_message('info', "[MOBILE] Tentativa invalida de login a partir do LOGIN \"{$origLogin}\" e SENHA \"{$origSenha}\"");
         $clie = FALSE;
      }
      
      echo json_encode($clie);
   }
}
