<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dieta_alimentos.
 */
class Dieta_alimento_model extends MY_Model {

   /**
    * @var string Nome da classe de neg�cio.
    */
   public $className = 'DietaAlimento';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta_alimento';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return dietaAlimento
    */
   public function mapArray2Obj(array $reg) {
   	/* @var DietaAlimento $dial */
      $dial           = new DietaAlimento();
      $dial->dieta  	 = new Dieta();
      $dial->alimento = new Alimento();
      
      $dial->idDietaAlimento      = $reg['iddieta_alimento'];
      $dial->dieta->idDieta  	    = $reg['iddieta'];
      $dial->alimento->idAlimento = $reg['idalimento'];
      $dial->turno                = $reg['turno'];

      return $dial;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param DietaAlimento $die_alim Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(DietaAlimento $dial) {
      return array(
      'iddieta_alimento' => $dial->idDietaAlimento,
      'iddieta'     	    => $dial->dieta->idDieta,
      'idalimento'       => $dial->alimento->idAlimento,
      'turno'            => $dial->turno);
   }
   
   public function carregaDietasAlimentosSite2App($idNutr) {
      $sel = "select dial.* "
      . "from dieta_alimento dial, "
      . "     dieta          diet "
      . "where dial.iddieta = diet.iddieta "
      . "and idnutricionista = {$idNutr}";
      $rs = $this->db->query($sel);
      $lista = array();
             
      foreach ($rs->result_array() as $reg) {
         $reg['turno'] = rawurlencode(utf8_encode($reg['turno']));
         $lista[] = $this->mapArray2Obj($reg);
      }
             
      return $lista;
   }
}