<?php
class Login extends MY_Controller {
   
   public function __construct() {
      parent::__construct(FALSE);
   }
   
   /**
    * P�gina espec�fica para o login do site
    */
   public function index() {
   	  $this->view->loginErro = $this->session->flashdata('loginErro');
      $this->load->view('site/conteudo/login$index.php', $this->view);
   }
   
   /**
    * Recebe a requisi��o de login de todos os tipos de usu�rios
    */
   public function action() {
      log_message('user', "Submissao do formul�rio de login, HTTP POST: "
      . print_r($this->input->post(), TRUE));
      
      $origSenha = $this->input->post('senha');
      $origLogin = $this->input->post('login');
      
      $login = mb_strtolower(addslashes(substr(trim($origLogin), 0, 20)));
      $senha = mb_strtolower(addslashes(substr(trim($origSenha), 0, 50)));

      try {
      	$nutr = $this->nutrModel->carregaNutricionistaLogin($login, $senha);
      	
      	$this->iniciaSessaoNutri($nutr);
      	 
      	log_message('user', "Nutricionista logado ");
      	 
      	redirect('nutri/inicio');
      } catch (Exception $e) {
      	// n�o encontrou a nutricionista
      }

      try {
      	$clie = $this->clieModel->carregaClienteLogin($login, $senha);
      	 
      	$this->iniciaSessaoClie($clie);
      	
      	log_message('user', "Nutricionista logado ");
      	
      	redirect('cliente/inicio');
      } catch (Exception $e) {
        // n�o encontrou cliente
      }
      
      $erro = array('loginErro' => TRUE);
      $this->session->set_flashdata($erro);
         
      log_message('error', "Erro no login. Informando o login \"{$origLogin}\" e a senha \"{$origSenha}\"");
         
      redirect('site/inicio');
   }
   
   /**
    * Seta na sess�o todas as informa��es, iniciais, necess�rias para o nutricionista 
    * @param Nutricionista $nutr
    */
   private function iniciaSessaoNutri($nutr) {
      $this->session->set_userdata('NUTRI_login', $nutr);
   }

   /**
    * Seta na sess�o todas as informa��es, iniciais, necess�rias para o nutricionista
    * @param Cliente $clie
    */
   private function iniciaSessaoClie($clie) {
      $this->session->set_userdata('CLIE_login', $clie);
   }
}