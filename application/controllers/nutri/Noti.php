<?php
/**
 * Controle do cadastro básico de notícias do nutricionista.
 */
class Noti extends MY_Controller {
   
   /**
    * @var Cliente Representação do registro no formulário de detalhes.
    */
   protected $noti;
   
   /**
    * @var string Configuração da action do formulário de detalhes.
    */
   protected $actionForm = 'index.php/nutri/noti/action/';
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->noti = new Noticia();
   }
   
   /**
    * Página principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
      $this->view->msgExclusao = $this->session->flashdata('msgExclusao');
      $this->view->listaNoti = $this->notiModel->carregaTodos();
      $this->view->listaNoti_qtdeReg = count($this->view->listaNoti);
      
      $this->topo('nutri');
	  $this->load->view('nutri/layout/lateral', $this->view);
      $this->load->view('nutri/conteudo/noti$index', $this->view);
      $this->rodape('nutri');
   }

   /**
    * Formulário de detalhes de registro, modos de inclusão e alteração.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclusão.
    */
   public function form($id = NULL) {
	  if ($id) {
         $this->noti = $this->notiModel->carrega($id);
      }
      
      $this->view->id = $id;
      $this->view->noti = $this->noti;
      $this->view->actionForm = $this->actionForm . $id;
      $this->view->msgErroForm = $this->session->flashdata('msgErroForm');
      
      $this->topo('nutri');
      $this->load->view('nutri/layout/lateral', $this->view);
      $this->load->view('nutri/conteudo/noti$form.php', $this->view);
      $this->rodape('nutri');
   }
    
   /**
    * Página do retorno do formulário de detalhes.
    * @return void
    */
   public function view() {
   		parent::gerenciadorRetornoFormulario('nutri', 'noti');
   }
    
   /**
    * Processa a submissão do formulário de detalhe de registro, tanto inclusão quanto alteração.
    * @param int $id ID/PK do registro, quando em modo de alteração.
    * @return void
    */
   public function action($id = NULL) {
	   	$this->objFromPost($id);
	   
	   	$flash['op'] = $id ? 'alterado' : 'incluído';
	   	$flash['ret'] = $this->notiModel->grava($this->noti);
	   	$flash['id'] = $this->noti->idNoticia;
	   
	   	$this->session->set_flashdata($flash);
	   
	   	redirect('nutri/noti/view');
   }
    
   /**
    * Cria um novo objeto a partir das informações do POST referentes ao formulário de detalhes.
    * @param int $id ID do registro, se em modo de alteração.
    * @return void
    */
   protected function objFromPost($id = NULL) {
	   	$this->noti = new Noticia();
	   	$this->noti->idNoticia = $id;
	   	$this->noti->nutricionista = $this->session->userdata('NUTRI_login');
	   	$this->noti->titulo = $this->input->post('texTitulo');
	   	$this->noti->descricao = $this->input->post('memDescricao');
	   
	   	if ($id == NULL) {
	   		$this->noti->dataCadastro = date('Y-m-d H:i:s');
	   	} else {
	   		$this->noti->dataCadastro = $this->input->post('hidDataCadastro');
	   	}
	   
	   	if ($_FILES['updImagem']['size']) {
	   		$rand = rand(111111, 999999);
	   		$config['upload_path']   = 'img/user/noti';
	   		$config['allowed_types'] = 'jpg|png';
	   		$config['max_size']      = 4096; // Bytes
	   		$config['file_name']     = date('Ymd_His') . $rand;
	   		$config['overwrite']     = FALSE;
	   
	   		$this->load->library('upload', $config);
	   
	   		if ($this->upload->do_upload("updImagem")) {
	   			log_message('user', '[NOTI] Upload sucesso!');
	   			$nomeArq = $this->upload->data('file_name');
	   			 
	   			geraMiniatura('noti', 'noti', 'img/user', $nomeArq, 600, 800);
	   			 
	   			$this->noti->imagem = $nomeArq;
	   
	   			if ($this->input->post('hidImagem')) {
	   				unlink('img/user/noti/' . $this->input->post('hidImagem'));
	   			}
	   		} else {
	   			log_message('error', '[NOTI] Erro no upload do arquivo! ' . $this->upload->display_errors());
	   		}
	   	} else {
	   		$this->noti->imagem = $this->input->post('hidImagem');
	   	}
   }
    
   /**
    * Exclui um registro conforme o ID passado por parâmetro.
    * @param int $id ID/PK do registro a ser excluído.
    */
   public function exclui($id) {
      try {
         $noti = $this->notiModel->carrega($id);
   
   	     parent::excluiRegistro($id, 'notiModel');
   	     unlink("img/user/noti/{$noti->imagem}");
   	  } catch (Exception $e) {
   	     log_message('error', "Problema ao excluir noticia ID {$id}");
   	  }
   
      redirect('nutri/noti');
   }
}