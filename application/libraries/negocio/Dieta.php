<?php
/**
 * Diet - Cadastro de Dieta
 */
class Dieta extends BusinessObject {

	public $idDieta;
	public $nutricionista;
	public $nome;
	public $ativo;
	public $dataCadastro;
	
	/*PSEUDO-ATRIBUTOS*/
	public $dietasAlimentos;
	public $htmlAlimentosVinculados;
}