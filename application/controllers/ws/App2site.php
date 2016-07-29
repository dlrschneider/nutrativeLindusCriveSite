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
      $obj = $this->input->post('obj');
                              
      $hial = new HistoricoAlimentacao();
      $hial->dietaHistorico = new DietaHistorico();
      
      $hial->dietaHistorico->idDietaHistorico = $obj[0];
      $hial->alimento = utf8_decode($obj[1]);
      $hial->turno = utf8_decode($obj[3]);
      $hial->dataCadastro = date('Y-m-d H:i:s', $obj[2] / 1000);
      
      $this->hialModel->grava($hial);
   }

   /**
    * Insere no banco as anotações feitas no app pelo cliente
    */
   public function notas() {
      $obj = $this->input->post('obj');
      
      $anot = new Anotacao();
      $anot->cliente = new Cliente();
      $anot->cliente->idCliente = $obj[0];
      $anot->descricao = uft8_decode($obj[1]);
      $anot->dataCadastro = date('Y-m-d H:i:s', $obj[1] / 1000);
      
      $this->anotModel->grava($anot);
   }
   
   /**
    * WS para login a partir do app mobile, em caso de sucesso retorna uma string JSON para o app
    */
   public function login($origLogin, $origSenha) {
      try {
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
