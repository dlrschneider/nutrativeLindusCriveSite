<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dieta_historicos.
 */
class Dieta_historico_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Dieta_historico';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta_historico';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return dieta_historico
    */
   public function mapArray2Obj(array $reg) {
   	/* @var dieta_historico $die_hist */
      $die_hist = new Dieta_historico();
      
      $die_hist->iddieta_historico = $reg['iddieta_historico'];
      $die_hist->iddieta           = $reg['iddieta'];
      $die_hist->idcliente         = $reg['idcliente'];
      
      return $die_hist;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Dieta_historico $die_hist Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Dieta_historico $die_hist) {
      return array(
      'iddieta_historico' => $die_hist->iddieta_historico,
      'iddieta'     		  => $die_hist->idDieta,
      'idcliente'         => $die_hist->idCliente);
   }
}