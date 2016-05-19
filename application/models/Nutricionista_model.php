<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de aulas.
 */
class Nutricionista_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Nutricionista';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'nutricionista';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return Nutricionista
    */
   public function mapArray2Obj(array $reg) {
   	/* @var Nutricionista $nutr */
      $nutr = new Nutricionista();
      
      $nutr->idNutricionista = $reg['idnutricionista'];
      $nutr->nome            = $reg['nome'];
      $nutr->cnpj            = $reg['cnpj'];
      $nutr->email           = $reg['email'];
      $nutr->estado          = $reg['estado'];
      $nutr->cidade          = $reg['cidade'];
      $nutr->bairro          = $reg['bairro'];
      $nutr->complemento     = $reg['complemento'];
      $nutr->ativo           = $reg['ativo'];
      $nutr->login           = $reg['login'];
      $nutr->senha            = $reg['senha'];
      $nutr->dataCadastro    = $reg['data_cadastro'];
      
      return $nutr;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Nutricionista $nutr Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Nutricionista $nutr) {
      return array(
      'nome'          => $nutr->nome,
      'cnpj'     	  => $nutr->cnpj,
      'email'         => $nutr->email,
      'estado'        => $nutr->estado,
      'cidade'        => $nutr->cidade,
      'bairro'        => $nutr->bairro,
      'complemento'   => $nutr->complemento,
      'ativo'         => $nutr->ativo,
      'login'         => $nutr->login,
      'senha'         => $nutr->senha,
      'data_cadastro' => $nutr->dataCadastro);
   }
   
   /**
    * Carrega um nutricionista a partir do login e senha
    * @param string $login
    * @param string $senha
    */
   public function carregaNutricionistaLogin($login, $senha) {
   	$sel = "select id{$this->tableName} "
   	. "from {$this->tableName} "
   	. "where login = '{$login}' and senha = '{$senha}'";
   	$rs = $this->db->query($sel);
   	$reg = $rs->row_array();
   	
   	return $this->carrega($reg["id{$this->tableName}"]);
   }
}