<?php
/**
 * Controle do cadastro b�sico de nutricionista.
 */
class Nutr  extends MY_Controller {
   
   /**
    * @var Nutricionista Representa��o do registro no formul�rio de detalhes.
    */
   protected $nutr;
   
   /**
    * @var string Configura��o da action do formul�rio de detalhes.
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
    * P�gina principal do cadastro, apresenta a listagem para consulta de registros.
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
    * Formul�rio de detalhes de registro, modos de inclus�o e altera��o.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclus�o.
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
    * P�gina do retorno do formul�rio de detalhes.
    * @return void
    */
   public function view() {
   	parent::gerenciadorRetornoFormulario('admin', 'nutr');
   }
   
   /**
    * Processa a submiss�o do formul�rio de detalhe de registro, tanto inclus�o quanto altera��o.
    * @param int $id ID/PK do registro, quando em modo de altera��o.
    * @return void
    */
   public function action($id = NULL) {
      $this->objFromPost($id);
      
      $flash['op'] = $id ? 'alterado' : 'inclu�do';
      $flash['ret'] = $this->nutrModel->grava($this->nutr);
      $flash['id'] = $this->nutr->idNutricionista;
      
      $this->session->set_flashdata($flash);
      
      redirect('admin/nutr/view');
   }
   
   /**
    * Cria um novo objeto a partir das informa��es do POST referentes ao formul�rio de detalhes.
    * @param int $id ID do registro, se em modo de altera��o.
    * @return void
    */
   protected function objFromPost($id) {
      $this->nutr = $this->nutrModel->carrega($id);
      $this->nutr->ativo = $this->input->post('cmbAtivo');
   }
   
   /**
    * Exclui um registro conforme o ID passado por par�metro.
    * @param int $id ID/PK do registro a ser exclu�do.
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
