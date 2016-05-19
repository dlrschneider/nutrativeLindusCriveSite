<?php
class Cadastro extends MY_Controller {
	
	public $nutri;
	
	public function __construct() {
		parent::__construct();
		
		$this->nutri = new Nutricionista();
	}
	
	public function index() {
		$this->view->retForm = $this->session->flashdata('inclusao');
		
		$this->topo();
		$this->load->view('site/conteudo/cadastro$index', $this->view);
		$this->rodape();
	}
	
	public function action() {
		if (!$this->input->post()) {
			redirect("site/cadastro");
		}
		
		$this->objFromPost();
		
		try {
			$this->nutrModel->grava($this->nutri);
			$ret = "<p class=\"alert alert-success\">Cadastro realizado com sucesso!</p>";
		} catch (ModelException $e) {
			$ret = "<p class=\"msgBdErro\">Erro ao se cadastrar, por favor tente mais tarde ou entre em contato conosco.</p>";
		}
		
		$this->session->set_flashdata('inclusao', $ret);
		redirect('site/cadastro');
	}
	
	private function objFromPost() {
		$this->nutri->nome = $this->input->post('texNome');
		$this->nutri->cnpj = $this->input->post('texCnpj');
		$this->nutri->email = $this->input->post('texEmail');
		$this->nutri->cidade = $this->input->post('texCidade');
		$this->nutri->estado = $this->input->post('cmbEstado');
		$this->nutri->bairro = $this->input->post('texBairro');
		$this->nutri->complemento = $this->input->post('texComplemento');
		$this->nutri->login = $this->input->post('texLogin');
		$this->nutri->senha = $this->input->post('pwdSenhaCadastro');
		$this->nutri->ativo = 'S';
		$this->nutri->dataCadastro = date('Y-m-d H:i:m');
	}
}