<?php
/**
 * CLIE - Cadastro de Clientes
 */
class Cliente extends BusinessObject {

	public $idCliente;
	public $idNutricionista; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $nome;
	public $altura;
	public $peso;
	public $login;
	public $senha;
	public $ativo;
	public $dataNascimento;
	public $dataCadastro;
	
	
	/* PSEUDO-ATRIBUTO */
	public $htmlPainelDieta;
}