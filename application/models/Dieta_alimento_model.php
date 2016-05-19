<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dieta_alimentos.
 */
class Dieta_alimento_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Dieta_alimento';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta_alimento';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return dieta_alimento
    */
   public function mapArray2Obj(array $reg) {
   	/* @var dieta_alimento $die_alim */
      $die_alim = new Dieta_alimento();
      
      $die_alim->iddieta_alimento = $reg['iddieta_alimento'];
      $die_alim->iddieta = 		  = $reg['idnutricionista'];
      $die_alim->idalimento       = $reg['nome'];
      
      return $die_alim;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Dieta_alimento $die_alim Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Dieta_alimento $die_alim) {
      return array(
      'iddieta_alimento' => $die_alim->idDieta_alimento,
      'iddieta'     		 => $die_alim->idDieta,
      'idalimento'       => $die_alim->idAlimento);
   }
}