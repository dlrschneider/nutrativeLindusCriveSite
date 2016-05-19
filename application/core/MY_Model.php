<?php
/**
 * Modelo de dados genérico pai de todos os modelos, para agrupar propriedades/métodos em comum a todos.
 */
class MY_Model extends CI_Model {
   
   /**
    * @var object Super objeto do framework CodeIgniter.
    */
   protected $CI;
   
   const MSG_REGISTRO_NAO_ENCONTRADO = 'Registro não encontrado';

   // RS O timeout do MySQL na hospedagem é 15 segundos.
   const TIMEOUT_MYSQL_LOCAWEB = 14;
   
   /**
    * Construtor.
    * @return void
    */
   public function __construct() {
      parent::__construct();
      $this->CI = &get_instance();
   }

   /**
    * Carrega um determinado registro conforme ID/PK da tabela
    * @var $id ID/PK do registro
    * @return Objeto
    */
   public function carrega($id) {
   	if (!$rs = $this->db->get_where($this->tableName, array("id{$this->tableName}" => $id))) {
   		throw new ModelException("ERRO AO CARREGAR REGISTRO \"{$this->tableName}\" A PARTIR DO CODIGO \"{$id}\"");
   	} else if (!$rs->num_rows()) {
   		throw new NegocioException(self::MSG_REGISTRO_NAO_ENCONTRADO);
   	}
   
   	$obj = $this->mapArray2Obj($rs->row_array());
   
   	return $obj;
   }

   /**
    * Carrega todos os registros da tabela
    * @return array Lista de objetos
    */
   public function carregaTodos($condicao = NULL) {
   	$sel = "select id{$this->tableName} "
      . "from {$this->tableName} "
      . $condicao;
   	$rs = $this->db->query($sel);
   	$lista = array();
   
   	foreach ($rs->result_array() as $reg) {
   		$lista[] = $this->carrega($reg["id{$this->tableName}"]);
   	}
   
   	return $lista;
   }
   

   /**
    * Insere um novo registro no banco de dados ou altera um registro já existente, a partir do conteúdo dos atributos
    * do objeto recebido por parâmetro. Após inserir, preenche o ID que foi gerado.
    * @param Objeto $obj
    * @return Boolean TRUE-Operação executada com sucesso, FALSE-Operação falhou.
    */
   public function grava($obj) {
   	$id = "id{$this->className}";
   	if ($obj->$id == NULL) {
   		$bdok = $this->db->insert($this->tableName, $this->mapObj2Array($obj));
   
   		if ($bdok) {
   			$obj->$id = $this->db->insert_id();
   		}
   	} else {
   		$this->db->where("id{$this->tableName}", $obj->$id);
   		$bdok = $this->db->update($this->tableName, $this->mapObj2Array($obj));
   	}
   	 
   	return $bdok;
   }
    
   /**
    * Exclui um registro do banco de dados.
    * @param int $id ID/PK do registro a ser excluído.
    * @return boolean TRUE se excluiu com sucesso, ou FALSE se ocorreu algum erro
    * e não pode excluir.
    */
   public function exclui($id) {
   	return $this->db->delete($this->tableName, array("id{$this->tableName}" => (int) $id));
   }
   
   /**
    * Reconecta ao MySQL se detectar o timeout imposto pela hospedagem da Locaweb, por exemplo, 15 segundos.
    * @return void
    */
   public function selectDummy($tempoInicio) {
      $duracao = time() - $tempoInicio;
   
      if ($duracao >= self::TIMEOUT_MYSQL_LOCAWEB) {
         log_message('user', "Reconectando ao MySQL para evitar timeout apos \"{$duracao}\" segundos ocioso...");
         $this->db->close();
         $this->db->initialize();
         log_message('user', "Reconectado ao MySQL: {$this->db->username}@{$this->db->hostname}/{$this->db->database}");
      }
   
      $this->db->query('select 0');
   }
   
   /**
    * Retorna a data/hora atual, para utilizar ao popular campos "data_cadastro", etc.
    * @version 1.0.0
    * @return string
    */
   protected function dataHoraAtual() {
      return date('Y-m-d H:i:s');
   }
}