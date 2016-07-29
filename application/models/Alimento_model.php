<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de alimentos.
 */
class Alimento_model extends MY_Model {

   /**
    * @var string Nome da classe de negÃ³cio.
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
      
      $alim->idAlimento      = $reg['idalimento'];
      $alim->nome            = $reg['nome'];
      $alim->carboidrato     = $reg['carboidrato'];
	  $alim->proteina        = $reg['proteina'];
	  $alim->lipidio         = $reg['lipidio'];
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
      'nome'     		=> $alim->nome,
	  'carboidrato'     => $alim->carboidrato,
	  'proteina'     	=> $alim->proteina,
	  'lipidio'  		=> $alim->lipidio,
      'data_cadastro'   => $alim->dataCadastro);
   }
   
   /**
    * Recupera os alimentos conforme a busca realizada
    * @param int $idDieta
    * @param string $busca
    * @return array
    */
   public function carregaAlimentosBusca($idDieta, $busca) {
	   $sel = "select * "
	   . "from alimento "
	   . "where nome like '%{$busca}%' "
	   . "and idalimento not in (select idalimento from dieta_alimento where iddieta = {$idDieta})"
	   . "order by nome";
	   $rs = $this->db->query($sel);
	   $lista = array();
	   	 
	   foreach ($rs->result_array() as $reg) {
	      $lista[] = $this->carrega($reg["id{$this->tableName}"]);
	   }
	   	 
	   return $lista;
   }
   
   /**
    * Carrega os alimentos necessários para a integração
    * @return array Alimento
    */
   public function carregaAlimentosSite2App() {
      $sel = "select * "
      . "from {$this->tableName}";
      $rs = $this->db->query($sel);
      $lista = array();
       
      foreach ($rs->result_array() as $reg) {
         $reg['nome'] = rawurlencode(utf8_encode($reg['nome']));
         $lista[] = $this->mapArray2Obj($reg);
      }
       
      return $lista;
   }
}