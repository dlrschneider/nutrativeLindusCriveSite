<?php
/**
 * Controle do cadastro básico de notícias do nutricionista.
 */
class Diet extends MY_Controller {
   
   /**
    * @var Dieta Representação do registro no formulário de detalhes.
    */
   protected $diet;
   
   /**
    * @var string Configuração da action do formulário de detalhes.
    */
   protected $actionForm = 'index.php/nutri/diet/action/';
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();

      $this->diet = new Dieta();
   }
   
   /**
    * Página principal do cadastro, apresenta a listagem para consulta de registros.
    * @return void
    */
   public function index() {
   	  $this->viewTopo->css = array('css/cliente/dieta.css');
   	
   	  $clie = $this->session->userdata('CLIE_login');
      
      $diet = $this->dietModel->carregaUltimaDieta($clie->idCliente);
      $diet->dietasAlimentos = $this->dialModel->carregaTodos("where iddieta = {$diet->idDieta}");

      $html = $this->load->view('nutri/fragmento/clie$form_dieta_abre_painel', array('diet' => $diet), TRUE);
      
      foreach ($diet->dietasAlimentos as $dial) {
       	 $dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
         $html .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
      }
      
      $html .= $this->load->view('nutri/fragmento/clie$form_dieta_fecha_painel', NULL, TRUE);
      $diet->htmlAlimentosVinculados = $html;
   	  
      $this->view->diet = $diet;
      
      $this->view->listaDihi = $this->dihiModel->carregaTodos("where idcliente = {$clie->idCliente}");
      foreach ($this->view->listaDihi as $dihi) {
      	$dihi->dieta = $this->dietModel->carrega($dihi->dieta->idDieta);
      }
      
      $this->view->listaDiet_qtdeReg = count($this->view->listaDihi);
      
      $this->topo('cliente');
	  $this->load->view('cliente/layout/lateral', $this->view);
      $this->load->view('cliente/conteudo/diet$index', $this->view);
      $this->rodape('cliente');
   }

   /**
    * Formulário de detalhes de registro, modos de inclusão e alteração.
    * @param int $id ID/PK do registro a ser alterado, NULL se for inclusão.
    */
   public function form($id = NULL, $alimento = FALSE) {
   	  $this->viewTopo->css = array('css/nutri/dieta.css');
   	
	  if ($id) {
         $this->diet = $this->dietModel->carrega($id);
         $this->diet->dietasAlimentos = $this->dialModel->carregaTodos("where iddieta = {$this->diet->idDieta}");
         
         $this->diet->htmlAlimentosVinculados = '';
         foreach ($this->diet->dietasAlimentos as $dial) {
         	$dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
         	$this->diet->htmlAlimentosVinculados .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
         }
      }
      
      $this->view->abaAlimento = $alimento;
      $this->view->id = $id;
      $this->view->diet = $this->diet;
      $this->view->actionForm = $this->actionForm . $id;
      $this->view->msgErroForm = $this->session->flashdata('msgErroForm');
      
      $this->topo('nutri');
      $this->load->view('nutri/layout/lateral', $this->view);
      $this->load->view('nutri/conteudo/diet$form.php', $this->view);
      $this->rodape('nutri');
   }
    
   /**
    * Página do retorno do formulário de detalhes.
    * @return void
    */
   public function view() {
   		parent::gerenciadorRetornoFormulario('nutri', 'diet');
   }
    
   /**
    * Processa a submissão do formulário de detalhe de registro, tanto inclusão quanto alteração.
    * @param int $id ID/PK do registro, quando em modo de alteração.
    * @return void
    */
   public function action($id = NULL) {
	   	$this->objFromPost($id);
	   
	   	if ($this->dietModel->grava($this->diet)) {
		   	redirect("nutri/diet/form/{$this->diet->idDieta}/alimento");
	   	} else {
		   	$flash['op'] = $id ? 'alterado' : 'incluído';
		   	$flash['ret'] = FALSE;
		   	$flash['id'] = FALSE;
		   	$this->session->set_flashdata($flash);
	   	}
	   
	   	redirect('nutri/diet/view');
   }
    
   /**
    * Cria um novo objeto a partir das informações do POST referentes ao formulário de detalhes.
    * @param int $id ID do registro, se em modo de alteração.
    * @return void
    */
   protected function objFromPost($id = NULL) {
	  $this->diet                = new Dieta();
	  $this->diet->idDieta     = $id;
	  $this->diet->nutricionista = $this->session->userdata('NUTRI_login');
      $this->diet->nome          = $this->input->post('texNome');
      $this->diet->ativo         = $this->input->post('cmbAtivo');
      
      if ($id == NULL) {
         $this->diet->dataCadastro = date('Y-m-d H:i:s');
      } else {
         $this->diet->dataCadastro = $this->input->post('hidDataCadastro');
      }
   }
    
   /**
    * Exclui um registro conforme o ID passado por parâmetro.
    * @param int $id ID/PK do registro a ser excluído.
    */
   public function exclui($id) {
      try {
         $diet = $this->dietModel->carrega($id);
   
   	     parent::excluiRegistro($id, 'dietModel');
   	  } catch (Exception $e) {
   	     log_message('error', "Problema ao excluir dieta ID {$id}");
   	  }
   
      redirect('nutri/diet');
   }
   
   /**
    * Realiza a busca por alimentos
    * @param int $idDieta
    */
   public function ajaxBuscaAlimento($idDieta) {
      $busca = addslashes(trim($this->input->post('busca')));
      $listaAlim = $this->alimModel->carregaAlimentosBusca($idDieta, $busca);
      $html = '';
      
      foreach ($listaAlim as $alim) {
         $this->view->alim = $alim;
         $html .= $this->load->view('nutri/fragmento/diet$form_alimento', $this->view, TRUE);
      }
      
      echo $html;
   }
   
   /**
    * Adiciona uma alimento a dieta
    * @param int $idDieta
    */
   public function ajaxAdicionaAlimento($idDieta) {
      $idAlimento = $this->input->post('idAlimento');
      
      try {
	      $dial = new DietaAlimento();
	      $dial->alimento = $this->alimModel->carrega($idAlimento);
	      $dial->dieta = $this->dietModel->carrega($idDieta);
	      
	      if ($this->dialModel->grava($dial)) {
	         $html = $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
	      } else {
	         throw new Exception("Erro ao adicionar alimento {$idAlimento} na dieta {$idDieta}");
	      }
      } catch (Exception $e) {
      	log_message('error', $e->getMessage());
      	$html = "ERRO";
      }
      
      echo $html;
   }

   /**
    * Remove um alimento da dieta
    * @param int $idDietaAlimento
    */
   public function ajaxRemoveAlimento($idDietaAlimento) {
      try {
   		 parent::excluiRegistro($idDietaAlimento, 'dialModel');
      } catch (Exception $e) {
   	     log_message('error', "Erro ao excluir dieta_alimento ID {$idDietaAlimento}");
      }
   }
}