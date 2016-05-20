<?php
class Login extends MY_Controller {
   
   public function __construct() {
      parent::__construct(FALSE);
   }
   
   public function index() {
   	  $this->view->loginErro = $this->session->flashdata('loginErro');
      $this->load->view('site/conteudo/login$index.php', $this->view);
   }
   
   public function action() {
      log_message('user', "Submissao do formul�rio de login, HTTP POST: "
      . print_r($this->input->post(), TRUE));
      
      $origSenha = $this->input->post('senha');
      $origLogin = $this->input->post('login');
      
      $login = mb_strtolower(addslashes(substr(trim($origLogin), 0, 20)));
      $senha = mb_strtolower(addslashes(substr(trim($origSenha), 0, 50)));

      try {
      	$nutr = $this->nutrModel->carregaNutricionistaLogin($login, $senha);
      	
      	$this->iniciaSessao();
      	 
      	log_message('user', "Nutricionista logado ");
      	 
      	redirect('nutri/inicio');
      } catch (Exception $e) {
      	// n�o encontrou a nutricionista
      }
      
      try {
      	$clie = $this->clieModel->carregaCliente($login, $senha);
      	 
      	$this->iniciaSessao();
      	
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
   
   protected function iniciaSessao() {
      $this->session->set_userdata('ADMIN_login', TRUE);
      
      //$this->session->set_userdata('pesqProd', new PesquisaProduto());
      //$this->session->set_userdata('pesqClie', new PesquisaCliente());
   }
}