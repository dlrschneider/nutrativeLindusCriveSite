<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de calendários.
 */
class Historico_alimentacao_model extends MY_Model {

   /**
    * @var string Nome da classe de calendário.
    */
   public $className = 'HistoricoAlimentacao';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'historico_alimentacao';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return HistoricoAlimentacao
    */
   public function mapArray2Obj(array $reg) {
   	/* @var HistoricoAlimentacao $hial */
      $hial = new HistoricoAlimentacao();
      $hial->dietaHistorico = new DietaHistorico();
      $hial->cliente = new Cliente();
      
      $hial->idHistoricoAlimentacao           = $reg['idhistorico_alimentacao'];
      $hial->dietaHistorico->idDietaHistorico = $reg['iddieta_historico'];
      $hial->cliente->idCliente               = $reg['idcliente'];
      $hial->alimento                         = $reg['alimento'];
      $hial->quantidade                       = $reg['quantidade'];
      $hial->turno                            = $reg['turno'];
      $hial->dataCadastro                     = $reg['data_cadastro'];
      
      return $hial;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param HistoricoAlimentacao $hial Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(HistoricoAlimentacao $hial) {
      return array(
      'iddieta_historico' => $hial->dietaHistorico->idDietaHistorico,
      'idcliente'         => $hial->cliente->idCliente,
      'alimento'          => $hial->alimento,
      'quantidade'        => $hial->quantidade,
      'turno'             => $hial->turno,
      'data_cadastro'     => $hial->dataCadastro);
   }
   
   /**
    * Limpa as informações de um determinado cliente para inclusão das informações vindas do mobile
    * @param int $idClie
    */
   public function limpaTabelaWS($idClie) {
      $del = "delete from historico_alimentacao where idcliente = {$idClie}";
      $this->db->query($del);
   }

   /**
    * Descobre a quantidade de alimentos que foram cadastrados pelos clientes em um determinado dia
    * @return int qtde
    */
   public function qtdeAlimentosCadastradosPelosClientes($data) {
      $sel = "select count(*) qtde "
      . "from (cliente         clie, "
      . "historico_alimentacao hial) "
      . "where clie.idcliente = hial.idcliente "
      . "and hial.data_cadastro like '%{$data}%'";
      $rs = $this->db->query($sel);
      $reg = $rs->row_array();
      return $reg['qtde'];
   }
}