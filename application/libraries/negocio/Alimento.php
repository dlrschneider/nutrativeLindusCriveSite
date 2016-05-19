<?php
/**
 * ALIM - Cadastro de Alimentos
 */
class Alimento extends BusinessObject {

	public $idAlimento;
	public $idCategoria; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $nome;
	public $carboidrato;
	public $proteina;
	public $lipidio;
	public $ativo;
	public $dataCadastro;
}