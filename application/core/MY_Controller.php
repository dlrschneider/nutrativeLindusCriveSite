  <?php
/**
 * Controlador abstrato, pai de todos os controladores, para agrupar funções que são comuns.
 * 
 */
class MY_Controller extends CI_Controller {
   
   /**
    * @var stdClass Variáveis para o topo
    */
   protected $viewTopo = NULL;
   
   /**
    * @var stdClass Variáveis para o rodapé
    */
   protected $viewRodape = NULL;

   /**
    * @var stdClass Dados da view principal (view do conteúdo).
    */
   protected $view;
   
   /**
    * Construtor.
    * @param boolean $validaLogin Se precisa verificar o login
    * @return void
    */
   public function __construct() {
      parent::__construct();

      if ($this->uri->segment(1) == 'nutri' && !$this->session->userdata('NUTRI_login') instanceof Nutricionista) {
         log_message('error', '*** GERENCIADOR DE CADASTROS SEM LOGIN NA SESSAO ***');
         redirect('site/inicio');
      } else if ($this->uri->segment(1) == 'cliente' && !$this->session->userdata('CLIE_login')) {
         log_message('error', '*** GERENCIADOR DE CADASTROS SEM LOGIN NA SESSAO ***');
         redirect('site/inicio');
      } else if ($this->uri->segment(1) == 'admin' && !$this->session->userdata('ADMIN_login')) {
         log_message('error', '*** GERENCIADOR DE CADASTROS SEM LOGIN NA SESSAO ***');
         redirect('site/inicio');
      }
      
      $this->viewTopo = new stdClass();
      $this->viewTopo->css = array();
      $this->viewTopo->js = array();
      
      $this->view = new stdClass();
      $this->viewRodape = new stdClass();
   }

   /**
    * Monta o topo do site, preparando os links dinâmicos de arquivos externos
    * de CSS e JavaScript.
    * @param string $tipoAcesso deve ser 'site' ou 'admin' 
    * @return void
    */
   protected function topo($tipoAcesso = 'site') {
      // Links de CSS.
      $sCss = '';
      
      foreach ($this->viewTopo->css as $css) {
         $sCss .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . base_url() . "{$css}\" />\n";
      }
      
      $this->viewTopo->htmlCss = $sCss;
          
      // Links de JavaScript.
      $sJs = '';
      
      foreach ($this->viewTopo->js as $js) {
         $sJs .= "<script type=\"text/javascript\" src=\"" . base_url() . "{$js}\" ></script>\n";
      }
      
      $this->viewTopo->htmlJs = $sJs;
      
      switch ($tipoAcesso) {
      	case 'nutri':
      		$this->viewTopo->nutr = $this->session->userdata('NUTRI_login');
      		break;
      	case 'cliente':
      		$this->viewTopo->clie = $this->session->userdata('CLIE_login');
      		break;
      	default:
      		break;
      }
      
      
      $this->load->view("{$tipoAcesso}/layout/topo", $this->viewTopo);
   }
   
   /**
    * Monta o rodapé do site, comum a todas as páginas.
    * @param string $tipoAcesso deve ser 'site' ou 'admin' 
    * @return void
    */
   protected function rodape($tipoAcesso = 'site') {
      if ($tipoAcesso == 'cliente') {
         $this->viewRodape->listaAnot = $this->anotModel->carregaTodos("where idcliente = {$this->session->userdata('CLIE_login')->idCliente}");
      }
      
      $this->load->view("{$tipoAcesso}/layout/rodape", $this->viewRodape);
   }

   /**
    * Página do retorno do formulário de detalhes.
    * @return void
    */
   protected function gerenciadorRetornoFormulario($tipo, $pagina) {
   	$this->view->id = $this->session->flashdata('id');
   
   	if ($this->session->flashdata('ret')) {
   		$this->view->msg = "<p class=\"msgBdSucesso\">Registro " . $this->session->flashdata('op') . " com sucesso!</p>\n";
   	} else {
   		$this->view->msg = "<p class=\"msgBdErro\">Registro não foi " . $this->session->flashdata('op') . "!<br /></p>\n";
   	}
   
   	$this->topo($tipo);
   	$this->load->view('nutri/layout/lateral', $this->view);
   	$this->load->view("{$tipo}/conteudo/{$pagina}\$view.php", $this->view);
   	$this->rodape($tipo);
   }

   /**
    * Exclui um registro conforme o ID passado por parâmetro.
    * @param int $id ID/PK do registro a ser excluído.
    */
   public function excluiRegistro($id, $model) {
   	$id = (int) $id;
   
   	if ($this->$model->exclui((int) $id)) {
   		$flash['msgExclusao'] = "<p class=\"msgBdSucesso\">Registro excluído com sucesso!</p>\n";
   	} else {
   		$flash['msgExclusao'] = "<p class=\"msgBdErro\">Não foi possível excluir o registro!<br />\n</p>\n";
   	}
   
   	$this->session->set_flashdata($flash);
   }
}
