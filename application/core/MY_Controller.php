<?php
/**
 * Controlador abstrato, pai de todos os controladores, para agrupar fun��es que s�o comuns.
 * 
 */
class MY_Controller extends CI_Controller {
   
   /**
    * @var stdClass Vari�veis para o topo
    */
   protected $viewTopo = NULL;
   
   /**
    * @var stdClass Vari�veis para o rodap�
    */
   protected $viewRodape = NULL;

   /**
    * @var stdClass Dados da view principal (view do conte�do).
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
      }
      
      $this->viewTopo = new stdClass();
      $this->viewTopo->css = array();
      $this->viewTopo->js = array();
      
      $this->view = new stdClass();
      $this->viewRodape = new stdClass();
   }

   /**
    * Monta o topo do site, preparando os links din�micos de arquivos externos
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
      
      $this->load->view("{$tipoAcesso}/layout/topo", $this->viewTopo);
   }
   
   /**
    * Monta o rodap� do site, comum a todas as p�ginas.
    * @param string $tipoAcesso deve ser 'site' ou 'admin' 
    * @return void
    */
   protected function rodape($tipoAcesso = 'site') {
      $this->load->view("{$tipoAcesso}/layout/rodape", $this->viewRodape);
   }

   /**
    * P�gina do retorno do formul�rio de detalhes.
    * @return void
    */
   protected function gerenciadorRetornoFormulario($tipo, $pagina) {
   	$this->view->id = $this->session->flashdata('id');
   
   	if ($this->session->flashdata('ret')) {
   		$this->view->msg = "<p class=\"msgBdSucesso\">Registro " . $this->session->flashdata('op') . " com sucesso!</p>\n";
   	} else {
   		$this->view->msg = "<p class=\"msgBdErro\">Registro n�o foi " . $this->session->flashdata('op') . "!<br /></p>\n";
   	}
   
   	$this->topo($tipo);
   	$this->load->view('nutri/layout/lateral', $this->view);
   	$this->load->view("{$tipo}/conteudo/{$pagina}\$view.php", $this->view);
   	$this->rodape($tipo);
   }

   /**
    * Exclui um registro conforme o ID passado por par�metro.
    * @param int $id ID/PK do registro a ser exclu�do.
    */
   public function excluiRegistro($id, $model) {
   	$id = (int) $id;
   
   	if ($this->$model->exclui((int) $id)) {
   		$flash['msgExclusao'] = "<p class=\"msgBdSucesso\">Registro exclu�do com sucesso!</p>\n";
   	} else {
   		$flash['msgExclusao'] = "<p class=\"msgBdErro\">N�o foi poss�vel excluir o registro!<br />\n</p>\n";
   	}
   
   	$this->session->set_flashdata($flash);
   }
}