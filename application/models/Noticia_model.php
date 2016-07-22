<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de dados do cadastro de noticias.
 */
class Noticia_model extends MY_Model {

   /**
    * @var string Nome da classe de negócio.
    */
   public $className = 'Noticia';
    
   /**
    * @var string Nome da tabela no banco de dados.
    */
   public $tableName = 'noticia';
      
   /**
    * Instancia um novo objeto a partir do registro no banco de dados.
    * @param array $reg Array contendo a estrutura de campos do registro.
    * @return Noticia
    */
   public function mapArray2Obj(array $reg) {
   	/* @var Noticia $noti */
      $noti = new Noticia();
      $noti->nutricionista = new Nutricionista();
      
      $noti->idNoticia = $reg['idnoticia'];
      $noti->nutricionista->idNutricionista = $reg['idnutricionista'];
      $noti->titulo = $reg['titulo'];
      $noti->descricao = $reg['descricao'];
      $noti->imagem = $reg['imagem'];
      $noti->dataCadastro    = $reg['data_cadastro'];
      
      return $noti;
   }
   
   /**
    * Mapeamento de um objeto para array (registro) conforme estrutura da tabela.
    * @param Noticia $noti Objeto a ser mapeado para array.
    * @return array
    */
   public function mapObj2Array(Noticia $noti) {
      return array(
      'idnutricionista' => $noti->nutricionista->idNutricionista,
      'titulo'     		=> $noti->titulo,
      'descricao'       => $noti->descricao,
      'imagem'          => $noti->imagem,
      'data_cadastro'   => $noti->dataCadastro);
   }
}