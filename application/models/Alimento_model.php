<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de alimentos.
 */
class Alimento_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Alimento';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'alimento';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return alimento
    */
   public function mapArray2Obj(array $reg) {
   	/* @var Alimento $alim */
      $alim = new Alimento();
      
      $alim->idalimento      = $reg['idalimento'];
      $alim->idcategoria     = $reg['idcategoria'];
      $alim->nome            = $reg['nome'];
      $alim->carboidrato     = $reg['carboidrato'];
	  $alim->proteina        = $reg['proteina'];
	  $alim->lipidio         = $reg['lipidio'];
      $alim->ativo           = $reg['ativo'];
      $alim->dataCadastro    = $reg['data_cadastro'];
      
      return $alim;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param alimento $alim Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Alimento $alim) {
      return array(
      'idalimento'      => $alim->idAlimento,
      'idcategoria'     => $alim->idCategoria,
      'nome'     		    => $alim->nome,
			'carboidrato'     => $alim->carboidrato,
			'proteina'     		=> $alim->proteina,
			'lipidio'  		    => $alim->lipidio,
      'data_nascimento' => $alim->dataNascimento,
      'ativo'           => $alim->ativo,
      'data_cadastro'   => $alim->dataCadastro);
   }
}