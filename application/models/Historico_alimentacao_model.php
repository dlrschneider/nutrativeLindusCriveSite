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
      
      $hial->idHistoricoAlimentacao           = $reg['idhistorico_alimentacao'];
      $hial->dietaHistorico->idDietaHistorico = $reg['iddieta_historico'];
      $hial->alimento                         = $reg['alimento'];
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
      'alimento'          => $hial->alimento,
      'turno'             => $hial->turno,
      'data_cadastro'     => $hial->dataCadastro);
   }
   
   /**
    * Descobre a quantidade de alimentos que foram cadastrados pelos clientes em um determinado dia
    * @return int qtde
    */
   public function qtdeAlimentosCadastradosPelosClientes($data) {
      $sel = "select count(*) qtde "
      . "from (cliente               clie, "
      . "      historico_alimentacao hial, "
      . "      dieta_historico       dihi) "
      . "where hial.iddieta_historico = dihi.iddieta_historico "
      . "and clie.idcliente = dihi.idcliente "
      . "and hial.data_cadastro like '%{$data}%'";
      $rs = $this->db->query($sel);
      $reg = $rs->row_array();
      return $reg['qtde'];
   }

   /**
    * Carrega o histórico de alimentação necessário para a integração
    * @param int $idCliente
    * @return array Alimento
    */
   public function carregaHistoricoAlimentacaoSite2App($idCliente) {
      $sel = "select * "
      . "from historico_alimentacao hial, "
      . "     dieta_historico       dihi "
      . "where dihi.iddieta_historico = hial.iddieta_historico "
      . "and dihi.idcliente = {$idCliente}";
      $rs = $this->db->query($sel);
      $lista = array();
             
      foreach ($rs->result_array() as $reg) {
         $reg['alimento'] = rawurlencode(utf8_encode($reg['alimento']));
         $reg['turno'] = rawurlencode(utf8_encode($reg['turno']));
         $lista[] = $this->mapArray2Obj($reg);
      }
             
      return $lista;
   }
}