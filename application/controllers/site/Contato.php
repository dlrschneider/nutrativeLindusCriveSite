<?php
class Contato extends MY_Controller {
    
/**
 * Contato.
 */

    public $nutri;
    
    public function __construct() {
        parent::__construct();
        
        $this->nutri = new Nutricionista();
    }
    
    public function index() {
        
        $this->topo();
        $this->load->view('site/conteudo/contato$index', $this->view);
        $this->rodape();
    }
}
?>
