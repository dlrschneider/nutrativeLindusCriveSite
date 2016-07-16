<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de clientes.
 */
class Anotacao_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Anotacao';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'anotacao';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return Anotacao
    */
   public function mapArray2Obj(array $reg) {
   	  /* @var Anotacao $anot */
      $anot = new Anotacao();
      $anot->cliente = new Cliente();
      
      $anot->idAnotacao         = $reg['idanotacao'];
      $anot->cliente->idCliente = $reg['idcliente'];
      $anot->descricao          = $reg['descricao'];
      $anot->dataCadastro       = $reg['data_cadastro'];
      
      return $anot;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Anotacao $anot Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Anotacao $anot) {
      return array(
      'idcliente'     => $anot->cliente->idCliente,
      'descricao'     => $anot->descricao,
      'data_cadastro' => $anot->dataCadastro);
   }
}