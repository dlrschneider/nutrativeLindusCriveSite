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

   /**
    * Recupera a alimentação do usuário em um determinado dia
    * @param String $data Data no formato YYYY-MM-DD
    * @return String html
    */
   public function ajaxRecuperaAlimentos($data, $idCliente, $idDietaHistorico) {
      $where = "where idcliente = {$idCliente} "
      . "and data_cadastro like '%{$data}%' "
      . "and iddieta_historico = {$idDietaHistorico}";
      $listaHial = $this->hialModel->carregaTodos($where);
   
      $html = '';
      foreach ($listaHial as $hial) {
         $html .= $this->addFormularioAlimentacao($hial);
      }
   
      imprimeHtmlAjax($html);
   }

   /**
    * Cria os campos do formulário
    * @param HistoricoAlimentacao $hial
    */
   public function addFormularioAlimentacao($hial = NULL) {
      if (!$hial) {
         $hial = new HistoricoAlimentacao();
      }
   
      return "<div class=\"boxFormAlimentacao\" data-id=\"{$hial->idHistoricoAlimentacao}\">"
      . "<input type=\"text\" class=\"texAlimento form-control\" value=\"{$hial->alimento}\"/>"
      . "<input type=\"text\" class=\"texQuantidade form-control\" value=\"" . formataValor($hial->quantidade) . "\"/>"
      . "<select class=\"cmbTurno form-control\">"
      . "   <option" . ($hial->turno == "Manhã"  ? " selected=\"select\" " : "")  . " value=\"Manhã\">Manhã</option>"
      . "   <option" . ($hial->turno == "Almoço" ? " selected=\"select\" " : "")  . " value=\"Almoço\">Almoço</option>"
      . "   <option" . ($hial->turno == "Lanche" ? " selected=\"select\" " : "")  . " value=\"Lanche\">Lanche</option>"
      . "   <option" . ($hial->turno == "Janta"  ? " selected=\"select\" " : "")  . " value=\"Janta\">Janta</option>"
      . "</select>"
      . "<span class=\"iconRemover glyphicon glyphicon-remove\"></span>"
      . "</div>";
   }
}
