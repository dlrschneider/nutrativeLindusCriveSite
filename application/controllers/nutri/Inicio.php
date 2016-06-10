<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Página inicial do gerênciador de cadastros
 */
class Inicio extends MY_Controller {
	
	/**
	 * DASHBOARD
	 * @since 29/01/2015
	 * @return void
	 */
	public function index() {
	   $this->topo('nutri');
	   $this->load->view('nutri/layout/lateral', $this->view);
	   $this->load->view('nutri/conteudo/inicio$index', $this->view);
	   $this->rodape('nutri');
	}

	/**
	 * Encerra a sessão do Gerenciador de Cadastros.
	 * @since 18/03/2015
	 * @return void
	 */
	public function logout() {
		log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
		
	   $this->session->unset_userdata('ADMIN_login');
	   redirect('site/inicio');
	}
}