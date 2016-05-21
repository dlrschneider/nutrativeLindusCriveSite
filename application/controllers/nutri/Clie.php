<?php
/**
 * Controle do cadastro básico de clientes do nutricionista.
 */
class Clie extends MY_Controller {
   
   /**
    * @var Cliente Representação do registro no formulário de detalhes.
    */
   protected $clie;
   
   /**
    * @var string Configuração da action do formulário de detalhes.
    */
   protected $actionForm = 'index.php/nutri/clie/action/';
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->clie = new Cliente();
   }
   
   /**
    * Página principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
   	  $this->viewTopo->css = array('css/nutri/clientes.css', 'css/nutri/pesquisa.css');
   	  
      $this->view->msgExclusao = $this->session->flashdata('msgExclusao');
      $this->view->listaClie = $this->clieModel->carregaTodos();
      $this->view->listaClie_qtdeReg = count($this->view->listaClie);
      
      $this->topo('nutri');
	   $this->load->view('nutri/layout/lateral', $this->view);
      $this->load->view('nutri/conteudo/clie$index', $this->view);
      $this->rodape('nutri');
   }
   
   /**
    * Formulário de detalhes de registro, modos de inclusão e alteração.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclusão.
    */
   public function form($id = NULL) {
      if ($id) {
         $this->clie = $this->clieModel->carrega($id);
      }
      
      $this->view->id = $id;
      $this->view->clie = $this->clie;
      $this->view->actionForm = $this->actionForm . $id;
      $this->view->msgErroForm = $this->session->flashdata('msgErroForm');
      
      $this->topo('nutri');
      $this->load->view('nutri/layout/lateral', $this->view);
      $this->load->view('nutri/conteudo/clie$form.php', $this->view);
      $this->rodape('nutri');
   }
   
   /**
    * Página do retorno do formulário de detalhes.
    * @return void
    */
   public function view() {
   	parent::gerenciadorRetornoFormulario('nutri', 'clie');
   }
   
   /**
    * Processa a submissão do formulário de detalhe de registro, tanto inclusão quanto alteração.
    * @param int $id ID/PK do registro, quando em modo de alteração.
    * @return void
    */
   public function action($id = NULL) {
      $this->objFromPost($id);
      
      $flash['op'] = $id ? 'alterado' : 'incluído';
      $flash['ret'] = $this->clieModel->grava($this->clie);
      $flash['id'] = $this->clie->idCliente;
      
      $this->session->set_flashdata($flash);
      
      redirect('nutri/clie/view');
   }
   
   /**
    * Cria um novo objeto a partir das informações do POST referentes ao formulário de detalhes.
    * @param int $id ID do registro, se em modo de alteração.
    * @return void
    */
   protected function objFromPost($id = NULL) {
      $this->clie = new Cliente();
      $this->clie->idCliente = $id;
      $this->clie->idNutricionista = 1;
      $this->clie->nome = $this->input->post('texNome');
      $this->clie->dataNascimento = formataDataMySql($this->input->post('texDataNascimento'));
      $this->clie->ativo = $this->input->post('cmbAtivo');
      
      if ($id == NULL) {
         $this->clie->dataCadastro = date('Y-m-d H:i:s');
      } else {
         $this->clie->dataCadastro = $this->input->post('hidDataCadastro');
      }
   }
   
   /**
    * Exclui um registro conforme o ID passado por parâmetro.
    * @param int $id ID/PK do registro a ser excluído.
    */
   public function exclui($id) {
   	
   	try {
   		parent::excluiRegistro($id, 'clieModel');
   	} catch (Exception $e) {
   		log_message('error', "Problema ao excluir cliente ID {$id}");
   	}
   	
      redirect('nutri/clie');
   }
}