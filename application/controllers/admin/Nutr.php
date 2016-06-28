<?php
/**
 * Controle do cadastro básico de nutricionista.
 */
class Nutr  extends MY_Controller {
   
   /**
    * @var Nutricionista Representação do registro no formulário de detalhes.
    */
   protected $nutr;
   
   /**
    * @var string Configuração da action do formulário de detalhes.
    */
   protected $actionForm = 'index.php/admin/nutr/action/';
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->nutr = new Nutricionista();
   }
   
   /**
    * Página principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
      $this->view->msgExclusao = $this->session->flashdata('msgExclusao');
      $this->view->listaNutr = $this->nutrModel->carregaTodos();
      $this->view->listaNutr_qtdeReg = count($this->view->listaNutr);
      
      $this->topo('admin');
	  $this->load->view('admin/layout/lateral', $this->view);
      $this->load->view('admin/conteudo/nutr$index', $this->view);
      $this->rodape('admin');
   }
   
   /**
    * Formulário de detalhes de registro, modos de inclusão e alteração.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclusão.
    */
   public function form($id) {
      $this->nutr = $this->nutrModel->carrega($id);
      
      $this->view->id = $id;
      $this->view->nutr = $this->nutr;
      $this->view->actionForm = $this->actionForm . $id;
      $this->view->msgErroForm = $this->session->flashdata('msgErroForm');
      
      $this->topo('admin');
      $this->load->view('admin/layout/lateral', $this->view);
      $this->load->view('admin/conteudo/nutr$form.php', $this->view);
      $this->rodape('admin');
   }
   
   /**
    * Página do retorno do formulário de detalhes.
    * @return void
    */
   public function view() {
   	parent::gerenciadorRetornoFormulario('admin', 'nutr');
   }
   
   /**
    * Processa a submissão do formulário de detalhe de registro, tanto inclusão quanto alteração.
    * @param int $id ID/PK do registro, quando em modo de alteração.
    * @return void
    */
   public function action($id = NULL) {
      $this->objFromPost($id);
      
      $flash['op'] = $id ? 'alterado' : 'incluído';
      $flash['ret'] = $this->nutrModel->grava($this->nutr);
      $flash['id'] = $this->nutr->idNutricionista;
      
      $this->session->set_flashdata($flash);
      
      redirect('admin/nutr/view');
   }
   
   /**
    * Cria um novo objeto a partir das informações do POST referentes ao formulário de detalhes.
    * @param int $id ID do registro, se em modo de alteração.
    * @return void
    */
   protected function objFromPost($id) {
      $this->nutr = $this->nutrModel->carrega($id);
      $this->nutr->ativo = $this->input->post('cmbAtivo');
   }
   
   /**
    * Exclui um registro conforme o ID passado por parâmetro.
    * @param int $id ID/PK do registro a ser excluído.
    */
   public function exclui($id) {
   	
   	try {
   		parent::excluiRegistro($id, 'nutrModel');
   	} catch (Exception $e) {
   		log_message('error', "Problema ao excluir nutricionista ID {$id}");
   	}
   	
      redirect('admin/nutr');
   }
}
