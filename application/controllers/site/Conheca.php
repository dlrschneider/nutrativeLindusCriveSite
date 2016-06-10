<?php
class Conheca extends MY_Controller {
    
/**
 * Sobre o sistema e a empresa.
 */

    public $nutri;
    
    public function __construct() {
        parent::__construct();
        
        $this->nutri = new Nutricionista();
    }
    
    public function index() {
        
        $this->topo();
        $this->load->view('site/conteudo/conheca$index', $this->view);
        $this->rodape();
    }
}
?>
