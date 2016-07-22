<?php
/**
 * Integra��o das informa��es do site para o app
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
      $listaAlim = $this->alimModel->carregaTodos();
      echo json_encode($listaAlim);
   }

   /**
    * Cria JSON com todas dietas de um determinado cliente
    * @param int $idCliente ID/PK do Cliente
    */
   public function dietas($idNutri) {
      $listaDiet = $this->dietModel->carregaTodos("where idnutricionista = {$idNutri}");
      echo json_encode($listaDiet);
   }
   
   /**
    * Cria JSON com todas dietas de um determinado cliente
    * @param int $idCliente ID/PK do Cliente
    */
   public function dietasHistorico($idCliente) {
      $listaDihi = $this->dihiModel->carregaTodos("where idcliente = {$idCliente}");
      echo json_encode($listaDihi);
   }

   /**
    * Cria JSON com todos as informa��es de alimentos cadastrados no calend�rio
    * @param int $idCliente ID/PK do Cliente
    */
   public function historicoAlimentacao($idCliente) {
      $listaHial = $this->hialModel->carregaTodos("where idcliente = {$idCliente}");
      echo json_encode($listaHial);
   }

   /**
    * Cria JSON com todas as not�cias de uma determinada nutricionista
    * @param int $idNutri ID/PK do Nutricionista 
    */
   public function noticias($idNutri) {
      $listaNoti = $this->notiModel->carregaTodos("where idnutricionista = {$idNutri}");
      
      foreach ($listaNoti as $noti) {
         $noti->nutricionista = $this->nutrModel->carrega($noti->nutricionista->idNutricionista);
      }
      
      echo json_encode($listaNoti);
   }
}
