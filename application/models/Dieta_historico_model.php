<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dieta_historicos.
 */
class Dieta_historico_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'DietaHistorico';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta_historico';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return DietaHistorico
    */
   public function mapArray2Obj(array $reg) {
   	/* @var DietaHistorico $dihi */
      $dihi = new DietaHistorico();
      
      $dihi->idDietaHistorico = $reg['iddieta_historico'];
      $dihi->idDieta          = $reg['iddieta'];
      $dihi->idCliente        = $reg['idcliente'];
      
      return $dihi;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param DietaHistorico $dihi Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(DietaHistorico $dihi) {
      return array(
      'iddieta_historico' => $dihi->idDietaHistorico,
      'iddieta'     	  => $dihi->idDieta,
      'idcliente'         => $dihi->idCliente);
   }
}