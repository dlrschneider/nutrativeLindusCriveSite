<?php
/**
 * Controle do cadastro b�sico de dietas do cliente
 */
class Inicio extends MY_Controller {
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->diet = new Dieta();
      $this->viewTopo->css = array('css/cliente/inicio.css');
   }
   
   /**
    * P�gina principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
      $clie = $this->session->userdata('CLIE_login');
      $this->view->listaNoti = $this->notiModel->carregaTodos("where idnutricionista = {$clie->idNutricionista}");
      
      $this->topo('cliente');
	   $this->load->view('cliente/layout/lateral', $this->view);
      $this->load->view('cliente/conteudo/inicio$index', $this->view);
      $this->rodape('cliente');
   }
}