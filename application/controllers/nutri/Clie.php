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
   	  $this->viewTopo->css = array('css/nutri/cliente.css', 'css/nutri/pesquisa.css');
   	  
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
    $this->viewTopo->css = array('css/nutri/cliente.css');
    $this->viewTopo->css = array('css/nutri/geral.css');
   	
      if ($id) {
         $this->clie = $this->clieModel->carrega($id);
	      $dietAtiva = $this->dietModel->carregaUltimaDieta($id);
	      $this->view->listaDiet = $this->dietModel->carregaTodos("where ativo = 'S'");
	      $this->view->listaAnot = $this->anotModel->carregaTodos("where idcliente = {$id} order by data_cadastro desc"); 
	      
	      $where = "where idcliente = {$id} "
	      . "and data_cadastro <> "
	      . "(select max(data_cadastro) from dieta_historico where idcliente = {$id}) "
	      . "order by data_cadastro desc";
	      
	      $this->view->listaDihi = $this->dihiModel->carregaTodos($where);
	      foreach ($this->view->listaDihi as $dihi) {
	      	$dihi->dieta = $this->dietModel->carrega($dihi->dieta->idDieta);
	      }
	      
	      $html = '';
	      if ($dietAtiva) {
		      $html .= $this->load->view('nutri/fragmento/clie$form_dieta_abre_painel', array('diet' => $dietAtiva), TRUE);
		      
		      foreach ($dietAtiva->dietasAlimentos as $dial) {
		      	$dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
		      	$html .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
		      }
		      
		      $html .= $this->load->view('nutri/fragmento/clie$form_dieta_fecha_painel', NULL, TRUE);
		      $dietAtiva->htmlAlimentosVinculados = $html;
	      }
	      
	      $this->view->dietAtiva = $dietAtiva;
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
      $this->clie->altura = formataValorMysql($this->input->post('texAltura'));
      $this->clie->peso = formataValorMysql($this->input->post('texPeso'));
      $this->clie->login = trim($this->input->post('texLogin'));
      $this->clie->senha = trim($this->input->post('pwdSenha'));
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

   /**
    * Adiciona uma alimento a dieta
    * @param int $idCliente
    */
   public function ajaxVinculaDieta($idCliente, $idDieta) {
   	try {
   		$dihi = new DietaHistorico();
   		$dihi->cliente = $this->clieModel->carrega($idCliente);
   		$dihi->dieta = $this->dietModel->carrega($idDieta);
   		$dihi->dataCadastro = date('Y-m-d H:i:s');
   		$html = '';
   		
   		if ($this->dihiModel->grava($dihi)) {
   			$dihi->dieta->dietasAlimentos = $this->dialModel->carregaTodos("where iddieta = {$dihi->dieta->idDieta}");
   			$html .= $this->load->view('nutri/fragmento/clie$form_dieta_abre_painel', array('diet' => $dihi->dieta), TRUE);
   			
   			foreach ($dihi->dieta->dietasAlimentos as $dial) {
   				$dial->alimento = $this->alimModel->carrega($dial->alimento->idAlimento);
   				$html .= $this->load->view('nutri/fragmento/diet$form_dieta_alimento', array('dial' => $dial), TRUE);
   			}
   			
   			$html .= $this->load->view('nutri/fragmento/clie$form_dieta_fecha_painel', NULL, TRUE);
   		} else {
   			throw new Exception("Erro ao vincular dieta {$idDieta} ao cliente {$idCliente}");
   		}
   	} catch (Exception $e) {
   		log_message('error', $e->getMessage());
   		$html = "ERRO";
   	}
   
   	echo $html;
   }
}
