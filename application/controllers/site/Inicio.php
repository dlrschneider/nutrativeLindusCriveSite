<?php
class Inicio extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// Adicionar aqui todos os css que ser�o utilizados nas views desta p�gina
		//$this->viewTopo->css = array('css/site/inicio.css');
		
		$this->topo();
		$this->load->view('site/conteudo/inicio$index');
		$this->rodape();
	}
}