<?php
class Login extends MY_Controller {
   
   public function __construct() {
      parent::__construct(FALSE);
   }
   
   /**
    * Página específica para o login do site
    */
   public function index() {
   	  $this->view->loginErro = $this->session->flashdata('loginErro');
      $this->load->view('site/conteudo/login$index.php', $this->view);
   }
   
   /**
    * Recebe a requisição de login de todos os tipos de usuários
    */
   public function action() {
      log_message('user', "Submissao do formulário de login, HTTP POST: "
      . print_r($this->input->post(), TRUE));
      
      $origSenha = $this->input->post('senha');
      $origLogin = $this->input->post('login');
      
      $login = mb_strtolower(addslashes(substr(trim($origLogin), 0, 20)));
      $senha = mb_strtolower(addslashes(substr(trim($origSenha), 0, 50)));

      if ($login == "admin" && $senha == "123") {
         $this->iniciaSessaoAdmin();
         redirect('admin/inicio');
      }
      
      try {
      	$nutr = $this->nutrModel->carregaNutricionistaLogin($login, $senha);
      	
      	$this->iniciaSessaoNutri($nutr);
      	 
      	log_message('user', "Nutricionista logado ");
      	 
      	redirect('nutri/inicio');
      } catch (Exception $e) {
      	// não encontrou a nutricionista
      }

      try {
      	$clie = $this->clieModel->carregaClienteLogin($login, $senha);
      	 
      	$this->iniciaSessaoClie($clie);
      	
      	log_message('user', "Nutricionista logado ");
      	
      	redirect('cliente/inicio');
      } catch (Exception $e) {
        // não encontrou cliente
      }
      
      $erro = array('loginErro' => TRUE);
      $this->session->set_flashdata($erro);
         
      log_message('error', "Erro no login. Informando o login \"{$origLogin}\" e a senha \"{$origSenha}\"");
         
      redirect('site/inicio');
   }
   
   /**
    * Seta na sessão todas as informações, iniciais, necessárias para o nutricionista 
    * @param Nutricionista $nutr
    */
   private function iniciaSessaoNutri($nutr) {
      $this->session->set_userdata('NUTRI_login', $nutr);
   }

   /**
    * Seta na sessão todas as informações, iniciais, necessárias para o nutricionista
    * @param Cliente $clie
    */
   private function iniciaSessaoClie($clie) {
      $this->session->set_userdata('CLIE_login', $clie);
   }
   
   private function iniciaSessaoAdmin() {
   	$this->session->set_userdata('ADMIN_login', TRUE);
   }
}