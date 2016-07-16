<?php
/**
 * Controle do cadastro básico de dietas do cliente
 */
class Diet extends MY_Controller {
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->diet = new Dieta();
      $this->viewTopo->css = array('css/cliente/dieta.css');
   }
   
   /**
    * Página principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
   	$clie = $this->session->userdata('CLIE_login');
      
      $diet = $this->dietModel->carregaUltimaDieta($clie->idCliente);
      $diet->dietasAlimentos = $this->dialModel->carregaTodos("where iddieta = {$diet->idDieta}");

      $html = $this->load->view('nutri/fragmento/clie$form_dieta_abre_painel', array('diet' => $diet), TRUE);
      
      foreach ($diet->dietasAlimentos as $dial) {
         $dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
         $html .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
      }
      
      $html .= $this->load->view('nutri/fragmento/clie$form_dieta_fecha_painel', NULL, TRUE);
      $diet->htmlAlimentosVinculados = $html;
   	  
      $this->view->diet = $diet;
      
      $this->view->listaDihi = $this->dihiModel->carregaTodos("where idcliente = {$clie->idCliente}");
      foreach ($this->view->listaDihi as $dihi) {
      	$dihi->dieta = $this->dietModel->carrega($dihi->dieta->idDieta);
      }
      
      $this->view->listaDiet_qtdeReg = count($this->view->listaDihi);
      
      $this->topo('cliente');
	   $this->load->view('cliente/layout/lateral', $this->view);
      $this->load->view('cliente/conteudo/diet$index', $this->view);
      $this->rodape('cliente');
   }
   
   /**
    * Detalhamento de uma dieta
    * @param int $idDihi ID/PK da Dieta_historico
    */
   public function detalhe($idDihi) {
      $dihi = $this->dihiModel->carrega($idDihi);
      $diet = $this->dietModel->carrega($dihi->dieta->idDieta);
      $diet->dietasAlimentos = $this->dialModel->carregaTodos("where iddieta = {$diet->idDieta}");
      
      $html = $this->load->view('nutri/fragmento/clie$form_dieta_abre_painel', array('diet' => $diet), TRUE);
      
      foreach ($diet->dietasAlimentos as $dial) {
         $dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
         $html .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
      }
      
      $html .= $this->load->view('nutri/fragmento/clie$form_dieta_fecha_painel', NULL, TRUE);
      $diet->htmlAlimentosVinculados = $html;
      
      $this->view->diet = $diet;
      $this->topo('cliente');
      $this->load->view('cliente/layout/lateral', $this->view);
      $this->load->view('cliente/conteudo/diet$detalhe', $this->view);
      $this->rodape('cliente');
   }

   /**
    * Encerra a sessão do Gerenciador de Cadastros.
    * @return void
    */
   public function logout() {
      log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
   
      $this->session->unset_userdata('CLIE_login');
      redirect('site/inicio');
   }
}