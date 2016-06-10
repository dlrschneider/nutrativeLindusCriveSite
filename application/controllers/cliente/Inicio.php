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
	   $this->topo('cliente');
	   $this->load->view('cliente/layout/lateral', $this->view);
	   $this->load->view('cliente/conteudo/inicio$index', $this->view);
	   $this->rodape('cliente');
	}

	/**
	 * Encerra a sessão do Gerenciador de Cadastros.
	 * @since 18/03/2015
	 * @return void
	 */
	public function logout() {
		log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
		
	   $this->session->unset_userdata('CLIE_login');
	   redirect('site/inicio');
	}
}