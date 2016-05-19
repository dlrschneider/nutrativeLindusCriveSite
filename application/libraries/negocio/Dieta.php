<?php
/**
 * Diet - Cadastro de Dieta
 */
class Dieta extends BusinessObject {

	public $idDieta;
	public $idNutricionista; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $caloria;
	public $dataNascimento;
	public $ativo;
	public $dataCadastro;
}