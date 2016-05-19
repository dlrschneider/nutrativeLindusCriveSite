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
   	  /* @var Categoria $cate */
      $cate = new Categoria();
      
      $cate->idcategoria  = $reg['idcategoria'];
      $cate->nome         = $reg['nome'];
      $cate->ativo        = $reg['ativo'];
      $cate->dataCadastro = $reg['data_cadastro'];
      
      return $cate;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Categoria $cate Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Categoria $cate) {
      return array(
      'idcategoria'   => $cate->idCategoria,
      'nome'     	  => $cate->nome,
      'ativo'         => $cate->ativo,
      'data_cadastro' => $cate->dataCadastro);
   }
}