<?php
/**
 * Funções de apoio referentes à formatação.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Formata uma data de "AAAA-MM-DD" para "DD/MM/AAAA".
 * @param string $pData
 * @param string $pSeculo
 * @since 24/02/2011
 * @return string
 */
function formataData($pData, $pSeculo = TRUE) {
	if (!empty($pData)) {
		return substr($pData, 8, 2) . '/' . substr($pData, 5, 2) . '/' . ($pSeculo ? substr($pData, 0, 4) : substr($pData, 2, 2));
	} else {
		return '';
	}
}

/**
 * Formata uma data/hora do formato padrão do MySQL para o formato da localização.
 * @since 24/02/2011
 * @param string $pData
 * @param boolean $pComSegundos
 * @param boolean $pComSeculo
 * @return string
 */
function formataDataHora($pData, $pComSegundos = TRUE, $pComSeculo = TRUE) {
	if (!empty($pData)) {
		return substr($pData, 8, 2) . '/' . substr($pData, 5, 2) . '/' . ($pComSeculo ? substr($pData, 0, 4) : substr($pData, 2, 2)) . ' ' . ($pComSegundos ? substr($pData, 11) : substr($pData, 11, 5));
	} else {
		return NULL;
	}
}

/**
 * Formata uma data do formato "DD/MM/AAAA" para o formato "AAAA-MM-DD", utilizado pelo MySQL.
 * @since 24/02/2011
 * @param string $pData A data/hora a ser formatada.
 * @return string A data/hora formatada.
 */
function formataDataMySql($pData) {
	if (!empty($pData)) {
		return substr($pData, 6, 4) . '-' . substr($pData, 3, 2) . '-' . substr($pData, 0, 2);
	} else {
		return NULL;
	}
}

/**
 * Formata um campo DATETIME do formato nativo do MySQL para o formato "HH:MM".
 * @since 24/02/2011
 * @param string $pData Data/hora a ser formatada.
 * @return string Hora formatada.
 */
function formataHora($pData) {
	if (!empty($pData)) {
		return substr($pData, 11, 5);
	} else {
		return NULL;
	}
}

/**
 * Formatação de valor monetário conforme a localização/idioma.
 * @param float $valor       Valor monetário a ser processado.
 * @param int   $pPrecisao   Precisão de casas decimais.
 * @param string $sepMilhar  Caractere separador de milhar.
 * @param string $sepDecimal Caractere separador de precisão decimal.
 * @since 24/02/2011
 * @version 1.0.1
 * @return string O valor formatado.
 */
function formataValor($valor, $pPrecisao = 2, $sepMilhar = '.', $sepDecimal = ',') {
	return number_format($valor, $pPrecisao, $sepDecimal, $sepMilhar);
}

/**
 * Remoção de caractere acentuados.
 * @param string $string
 * @since 25/09/2011
 * @return string
 */
function removeAcentos($string) {
	$caracteres = array(
			"/[ÂÀÁÄÃ]/"=>"A", "/[âãàáä]/"=>"a", "/[ÊÈÉË]/"=>"E", "/[êèéë]/"=>"e",
			"/[ÎÍÌÏ]/"=>"I", "/[îíìï]/"=>"i", "/[ÔÕÒÓÖ]/"=>"O", "/[ôõòóö]/"=>"o",
			"/[ÛÙÚÜ]/"=>"U", "/[ûúùü]/"=>"u", "/ç/"=>"c", "/Ç/"=> "C", "/º/" => "o");
	return preg_replace(array_keys($caracteres), array_values($caracteres), $string);
}

/**
 * Verifica se uma string tem comprimento zero e neste caso retorna NULL, caso contrário retorna a própria string.
 * @param string $string
 * @since 28/09/2011
 * @return mixed NULL se a string for NULL ou vazia (string de comprimento zero), ou string se for uma string não vazia.
 */
function s0($string) {
	if (is_null($string)) {
		return NULL;
	} else {
		return strlen($string) == 0 ? NULL : $string;
	}
}

/**
 * Formata um CPF de "99.999.999-99" para "9999999999".
 * @param string $cpf
 * @since 20/06/2014
 * @version 1.0.0
 * @return string
 */
function formataCpfMySql($cpf) {
	if (strlen($cpf) == 14) {
		return str_ireplace(array(".", "-"), "", $cpf);
	} else {
		return $cpf;
	}
}

/**
 * Formata um CPF de "99999999999" para "999.999.999-99".
 * @param $cpf
 * @since 20/06/2014
 * @version 1.0.0
 * @return mixed
 */
function formataCpf($cpf) {
	if ((strlen($cpf) == 11) && (is_numeric($cpf))) {
		$parte1 = substr($cpf, 0, 3);
		$parte2 = substr($cpf, 3, 3);
		$parte3 = substr($cpf, 6, 3);
		$parte4 = substr($cpf, 9, 2);
		return "{$parte1}.{$parte2}.{$parte3}-{$parte4}";
	} else {
		return $cpf;
	}
}

/**
 * Formata um CNPJ do formato apenas números para o formato "99.999.999/9999-99".
 * @param string $cnpj
 * @since 20/10/2011
 * @return string
 */
function formataCnpj($cnpj) {
	return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-'
	. substr($cnpj, -2);
}

/**
 * Formata um CNPJ para valor apenas numérico "99999999999999".
 * @param string $cnpj
 * @since 25/03/2015
 * @return string
 */
function formataCnpjMysql($cnpj) {
   return substr($cnpj, 0, 2) . substr($cnpj, 3, 3) . substr($cnpj, 7, 3) . substr($cnpj, 11, 4) . substr($cnpj, -2);
}

/**
 * Enter description here ...
 * @param string $cep
 * @since 20/10/2011
 */
function formataCep($cep) {
   return substr($cep, 0, 5) . '-' . substr($cep, 5);
}

/**
 * Remove a formatação para inserir apenas números no banco de "99999-999" para "99999999"
 * @param string $cep
 * @since 20/10/2011
 */
function formataCepMysql($cep) {
   return substr($cep, 0, 5) . substr($cep, -3);
}

/**
 * Enter description here ...
 * @param string $ativo
 * @since 06/09/2013
 * @version 1.0.0
 * @return string
 */
function formataAtivo($ativo) {
	return $ativo == 'S' ? '<span style="color: green;">Sim</span>' : '<span style="color: red;">Não</span>';
}

/**
 * Formata uma string "S/N" para "Sim/Não" em verde/vermelho.
 * @param string $simNao
 * @since 31/01/2012
 * @return string
 */
function formataSimNao($simNao) {
	return $simNao == 'S' ? '<span style="color: green;">Sim</span>' : '<span style="color: red;">Não</span>';
}

/**
 * Formata uma string já formatada em moeda brasileira para o formato nativo do MySQL.
 * @param string $valor
 * @since 06/09/2013
 * @version 1.0.0
 * @return string
 */
function formataValorMysql($valor) {
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", ".", $valor);
	return $valor;
}

/**
 * Enter description here ...
 * @param string $valor String a ser formatada
 * @param string $clausula Será comparado com o valor para definir se é verde, caso seja diferente, valor deve ficar vermelho
 * @since 30/09/2014
 * @return string
 */
function formataVerdeVermelho($valor, $clausula) {
	return $valor == $clausula ? "<span style=\"color: green;\">{$valor}</span>" : "<span style=\"color: red;\">{$valor}</span>";
}

/**
 * 
 * @param string $tipo Campo tipoCliente (5 - inativo, 8 - prospecto, E - especial) da tabela cliente
 * @return string
 */
function formataTipoCliente($tipo) {
   switch ($tipo) {
      case Cliente::TIPO_CLIENTE_INATIVO:
         return 'Inativo';
         break;
      case Cliente::TIPO_CLIENTE_PROSPECTO:
         return 'Prospecto';
         break;
      case Cliente::TIPO_CLIENTE_ESPECIAL:
         return 'Especial';
         break;
   }
}