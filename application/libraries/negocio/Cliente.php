<?php
/**
 * CLIE - Cadastro de Clientes
 */
class Cliente extends BusinessObject {

	public $idCliente;
	public $idNutricionista; // TODO TRANSFORMAR EM OBJ NUTRICIONISTA
	public $nome;
	public $ativo;
	public $dataNascimento;
	public $dataCadastro;
}