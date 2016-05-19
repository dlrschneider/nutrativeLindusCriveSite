<?php
/**
 * ALIM - Cadastro de Alimentos
 */
class Alimento extends BusinessObject {

	public $idalimento;
	public $idcategoria; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $nome;
	public $carboidrato;
	public $proteina;
	public $lipidio;
	public $ativo;
	public $dataCadastro;
}