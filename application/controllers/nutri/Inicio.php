<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * P�gina inicial do ger�nciador de cadastros
 */
class Inicio extends MY_Controller {
	
	/**
	 * DASHBOARD
	 * @since 29/01/2015
	 * @return void
	 */
	public function index() {
	   $this->topo('nutri');
	   $this->load->view('admin/conteudo/', $this->view);
	   $this->rodape('nutri');
	}

	/**
	 * Encerra a sess�o do Gerenciador de Cadastros.
	 * @since 18/03/2015
	 * @return void
	 */
	public function logout() {
		log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
		
	   $this->session->unset_userdata('ADMIN_login');
	   redirect('site/login');
	}
}