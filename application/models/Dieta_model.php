<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dietas.
 */
class Dieta_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Dieta';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return Dieta
    */
   public function mapArray2Obj(array $reg) {
   	/* @var Dieta $diet */
      $diet = new Dieta();
      
      $diet->idDieta         = $reg['iddieta'];
      $diet->idNutricionista = $reg['idnutricionista'];
      $diet->caloria         = $reg['caloria'];
      $diet->dataNascimento  = $reg['data_nascimento'];
      $diet->ativo           = $reg['ativo'];
      $diet->dataCadastro    = $reg['data_cadastro'];
      
      return $diet;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Dieta $diet Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Dieta $die) {
      return array(
	  'iddieta'         => $die->idDieta,
      'idnutricionista' => $die->idNutricionista,
      'caloria'   		=> $die->caloria,
      'data_nascimento' => $die->dataNascimento,
      'ativo'           => $die->ativo,
      'data_cadastro'   => $die->dataCadastro);
   }
}