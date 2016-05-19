<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de categorias.
 */
class Categoria_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Categoria';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'categoria';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return categoria
    */
   public function mapArray2Obj(array $reg) {
   	/* @var categoria $categ */
      $categ = new Categoria();
      
      $categ->idcategoria       = $reg['idcategoria'];
      $categ->nome              = $reg['nome'];
      $categ->ativo             = $reg['ativo'];
      $categ->dataCadastro      = $reg['data_cadastro'];
      
      return $categ;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param categoria $categ Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Categoria $categ) {
      return array(
      'idcategoria'     => $categ->idCategoria,
      'nome'     		    => $categ->nome,
      'ativo'           => $categ->ativo,
      'data_cadastro'   => $categ->dataCadastro);
   }
}