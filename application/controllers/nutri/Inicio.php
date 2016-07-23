<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Página inicial do gerênciador de cadastros
 */
class Inicio extends MY_Controller {
	
	/**
	 * DASHBOARD
	 * @return void
	 */
	public function index() {
	   $this->viewTopo->css = array('css/nutri/inicio.css');
	   
	   $listaDias = '';
	   $listaQtdeCadastraram = '';
	   $listaQtdeClientes = '';
	   for ($i = 30; $i >= 0; $i--) {
	      $timestamp = time();
	      $tm = 86400 * $i;
	      $tm = $timestamp - $tm;
	   
	      $listaDias .= "'" . date("d/m", $tm) . "',";
	      
	      $dataMysql = date("Y-m-d", $tm);
	      
	      $listaQtdeCadastraram .= $this->hialModel->qtdeAlimentosCadastradosPelosClientes($dataMysql) . ',';
	      $listaQtdeClientes .= $this->clieModel->qtdeClientesNaoCadastrouAlimentos($dataMysql) . ',';
	      
	   }
	   
	   $this->view->listaDias = substr($listaDias, 0, -1);
	   $this->view->listaQtdeCadastraram = substr($listaQtdeCadastraram, 0, -1);
	   $this->view->listaQtdeClientes = substr($listaQtdeClientes, 0, -1);
	   
	   $this->view->qtdeAtivos   = $this->clieModel->qtdeClientesAtivos();
	   $this->view->qtdeInativos = $this->clieModel->qtdeClientesInativos();
	   
	   $this->topo('nutri');
	   $this->load->view('nutri/layout/lateral', $this->view);
	   $this->load->view('nutri/conteudo/inicio$index', $this->view);
	   $this->rodape('nutri');
	}

	/**
	 * Encerra a sessão do Gerenciador de Cadastros.
	 * @return void
	 */
	public function logout() {
		log_message('user', '*** LOGOUT NO GERENCIADOR DE CADASTROS ***');
		
	   $this->session->unset_userdata('ADMIN_login');
	   redirect('site/inicio');
	}
}