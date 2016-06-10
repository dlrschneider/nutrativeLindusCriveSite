<?php
class Planos extends MY_Controller {
    
/**
 * Controle do cadastramento por planos do sistema de nutricionistas.
 */

    public $nutri;
    
    public function __construct() {
        parent::__construct();
        
        $this->nutri = new Nutricionista();
    }
    
    public function index() {
        $this->view->retForm = $this->session->flashdata('inclusao');
        
        $this->topo();
        $this->load->view('site/conteudo/planos$index', $this->view);
        $this->rodape();
    }

    public function action() {
        if (!$this->input->post()) {
            redirect("site/planos");
        }
    }
}
?>
