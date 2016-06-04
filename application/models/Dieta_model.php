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
      $diet->nutricionista   = new Nutricionista($reg['idnutricionista']);
      $diet->nome 			 = $reg['nome'];
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
      'idnutricionista'   => $die->nutricionista->idNutricionista,
      'nome'      		=> $die->nome,
      'ativo'           => $die->ativo,
      'data_cadastro'   => $die->dataCadastro);
   }
   
   /**
    * Recupera ultima dieta ativa para um determinado cliente
    * @param int $idCliente ID/PK
    */
   public function carregaUltimaDieta($idCliente) {
      $sel = "select dihi.iddieta, dihi.idcliente, max(dihi.data_cadastro) from "
      . "(dieta_historico dihi, "
      . " dieta           diet) "
      . "where diet.iddieta = dihi.iddieta "
      . "and dihi.idcliente = {$idCliente} ";
      $rs = $this->db->query($sel);
      $reg = $rs->row_array();
      
      if ($reg['iddieta']) {
      	
	      $diet = $this->carrega($reg["iddieta"]);
	      $diet->dietasAlimentos = $this->CI->dialModel->carregaTodos("where iddieta = {$reg['iddieta']}");
	      
	      foreach ($diet->dietasAlimentos as $dial) {
	         $dial->alimento = $this->CI->alimModel->carrega($dial->alimento->idAlimento);
	      }
	      
	      return $diet;
      } else {
      	return FALSE;
      }
   }
}