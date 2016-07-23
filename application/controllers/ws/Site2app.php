<?php
/**
 * Integração das informações do site para o app
 */
class Site2app extends MY_Controller {
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();
   }
   
   /**
    * Cria JSON com todos os alimentos do sistema
    */
   public function alimentos() {
      $listaAlim = $this->alimModel->carregaAlimentosSite2App();
      echo json_encode($listaAlim);
   }

   /**
    * Cria JSON com todas dietas de um determinado cliente
    * @param int $idCliente ID/PK do Cliente
    */
   public function dietas($idNutri) {
      $listaDiet = $this->dietModel->carregaDietasSite2App($idNutri);
      echo json_encode($listaDiet);
   }
   
   /**
    * Cria JSON com todas dietas de um determinado cliente
    * @param int $idCliente ID/PK do Cliente
    */
   public function dietasHistorico($idCliente) {
      $listaDihi = $this->dihiModel->carregaDietasHistoricosSite2App($idCliente);
      echo json_encode($listaDihi);
   }

   /**
    * Cria JSON com todos as informações de alimentos cadastrados no calendário
    * @param int $idCliente ID/PK do Cliente
    */
   public function historicoAlimentacao($idCliente) {
      $listaHial = $this->hialModel->carregaHistoricoAlimentacaoSite2App($idCliente);
      echo json_encode($listaHial);
   }

   /**
    * Cria JSON com todas as notícias de uma determinada nutricionista
    * @param int $idNutri ID/PK do Nutricionista 
    */
   public function noticias($idNutri) {
      $listaNoti = $this->notiModel->carregaNoticiasSite2App($idNutri);
      
      foreach ($listaNoti as $noti) {
         $noti->nutricionista = $this->nutrModel->carrega($noti->nutricionista->idNutricionista);
      }
      
      echo json_encode($listaNoti);
   }
}
