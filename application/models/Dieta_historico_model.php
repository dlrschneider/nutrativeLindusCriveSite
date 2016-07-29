<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de dieta_historicos.
 */
class Dieta_historico_model extends MY_Model {

   /**
    * @var string Nome da classe de negÃ³cio.
    */
   public $className = 'DietaHistorico';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'dieta_historico';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return DietaHistorico
    */
   public function mapArray2Obj(array $reg) {
   	  /* @var DietaHistorico $dihi */
      $dihi = new DietaHistorico();
      $dihi->dieta = new Dieta();
      $dihi->cliente = new Cliente();
      
      $dihi->idDietaHistorico   = $reg['iddieta_historico'];
      $dihi->dieta->idDieta     = $reg['iddieta'];
      $dihi->cliente->idCliente = $reg['idcliente'];
      $dihi->dataCadastro       = $reg['data_cadastro'];
      
      return $dihi;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param DietaHistorico $dihi Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(DietaHistorico $dihi) {
      return array(
      'iddieta_historico' => $dihi->idDietaHistorico,
      'iddieta'     	  => $dihi->dieta->idDieta,
      'idcliente'         => $dihi->cliente->idCliente,
      'data_cadastro'     => $dihi->dataCadastro);
   }

   /**
    * Recupera ultima dieta_historico do cliente
    * @param int $idCliente ID/PK
    */
   public function carregaUltimaDietaHistorico($idCliente) {
      $sel = "select max(iddieta_historico) iddieta_historico from dieta_historico where idcliente = {$idCliente} ";
      $rs = $this->db->query($sel);
      $reg = $rs->row_array();
   
      return $this->carrega($reg["iddieta_historico"]);
   }

   /**
    * Carrega as dietas históricos necessários para a integração
    * @param int $idClie
    * @return array Alimento
    */
   public function carregaDietasHistoricosSite2App($idClie) {
      $sel = "select * "
      . "from {$this->tableName} "
      . "where idcliente = {$idClie}";
      $rs = $this->db->query($sel);
      $lista = array();
             
      foreach ($rs->result_array() as $reg) {
         $lista[] = $this->mapArray2Obj($reg);
      }
             
      return $lista;
   }
}