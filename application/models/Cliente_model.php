<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de clientes.
 */
class Cliente_model extends MY_Model {

   /**
    * @var string Nome da classe de neg�cio.
    */
   public $className = 'Cliente';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'cliente';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return Cliente
    */
   public function mapArray2Obj(array $reg) {
   	/* @var Cliente $clie */
      $clie = new Cliente();
      
      $clie->idCliente       = $reg['idcliente'];
      $clie->idNutricionista = $reg['idnutricionista'];
      $clie->nome            = $reg['nome'];
      $clie->dataNascimento  = $reg['data_nascimento'];
      $clie->ativo           = $reg['ativo'];
      $clie->dataCadastro    = $reg['data_cadastro'];
      
      return $clie;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Cliente $clie Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Cliente $clie) {
      return array(
      'idnutricionista' => $clie->idNutricionista,
      'nome'     		   => $clie->nome,
      'data_nascimento' => $clie->dataNascimento,
      'ativo'           => $clie->ativo,
      'data_cadastro'   => $clie->dataCadastro);
   }
}