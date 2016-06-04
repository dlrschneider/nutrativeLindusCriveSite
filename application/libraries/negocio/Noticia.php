<?php
/**
 * NOTI - Cadastro de Notícias
 */
class Noticia extends BusinessObject {

	public $idNoticia;
	public $nutricionista; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $titulo;
	public $descricao;
	public $imagem;
	public $dataCadastro;
}