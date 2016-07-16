<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * P�gina inicial do ger�nciador de cadastros
 */
class Inicio extends MY_Controller {
	
	/**
	 * DASHBOARD
	 * @return void
	 */
	public function index() {
	   $this->topo('admin');
	   $this->load->view('admin/layout/lateral', $this->view);
	   $this->load->view('admin/conteudo/inicio$index', $this->view);
	   $this->rodape('admin');
	}

	/**
	 * Encerra a sess�o do Gerenciador de Cadastros.
	 * @return void
	 */
	public function logout() {
		log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
		
	   $this->session->unset_userdata('ADMIN_login');
	   redirect('site/inicio');
	}
}