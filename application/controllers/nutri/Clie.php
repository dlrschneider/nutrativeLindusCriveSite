<?php
/**
 * Controle do cadastro b�sico de clientes do nutricionista.
 */
class Clie extends MY_Controller {
   
   /**
    * @var Cliente Representa��o do registro no formul�rio de detalhes.
    */
   protected $clie;
   
   /**
    * @var string Configura��o da action do formul�rio de detalhes.
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
    * P�gina principal do cadastro, apresenta a listagem para consulta de registros.
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
    * Formul�rio de detalhes de registro, modos de inclus�o e altera��o.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclus�o.
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
    * P�gina do retorno do formul�rio de detalhes.
    * @return void
    */
   public function view() {
   	parent::gerenciadorRetornoFormulario('nutri', 'clie');
   }
   
   /**
    * Processa a submiss�o do formul�rio de detalhe de registro, tanto inclus�o quanto altera��o.
    * @param int $id ID/PK do registro, quando em modo de altera��o.
    * @return void
    */
   public function action($id = NULL) {
      $this->objFromPost($id);
      
      $flash['op'] = $id ? 'alterado' : 'inclu�do';
      $flash['ret'] = $this->clieModel->grava($this->clie);
      $flash['id'] = $this->clie->idCliente;
      
      $this->session->set_flashdata($flash);
      
      redirect('nutri/clie/view');
   }
   
   /**
    * Cria um novo objeto a partir das informa��es do POST referentes ao formul�rio de detalhes.
    * @param int $id ID do registro, se em modo de altera��o.
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
    * Exclui um registro conforme o ID passado por par�metro.
    * @param int $id ID/PK do registro a ser exclu�do.
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