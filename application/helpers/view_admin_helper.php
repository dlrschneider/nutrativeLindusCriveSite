<?php
if (!defined('BASEPATH')) exit("<h1>Acesso Negado</h1>\n<h3>Vá embora hacker malvado!</h3>");

/**
 * Funções comuns a todas as telas e opções do Gerenciador de Conteúdo.
 */

/**
 * Monta o cabeçalho de título de página de cadastro.
 * @param string $titulo
 * @param int $qtdeReg
 */
function tituloCadastro ($titulo, $qtdeReg = NULL) {
   echo "<h1 class=\"tituloCadastro\">{$titulo}";

   if ($qtdeReg != NULL) {
      echo " <span style=\"font-size: 10pt;\">({$qtdeReg} registro" . ($qtdeReg >= 2 ? 's' : '') . ')</span> ';
   }
   
   echo "</h1>\n";
}

/**
 * Monta o cabeçalho de subtítulos
 * @param string $subtitulo
 * @param int $qtdeReg
 */
function subtituloCadastro ($subtitulo, $qtdeReg = NULL) {
   echo "<h3 class=\"subtituloCadastro\">{$subtitulo} "
   . "<span style=\"font-size: 9pt;\">";

   if ($qtdeReg != NULL) {
      echo "({$qtdeReg} registro" . ($qtdeReg >= 2 ? 's' : '') . ')';
   }
   
   echo "</span> </h3>\n";
}

/**
 * Retorna linha padrão de tabela de registros, contendo mensagem de nenhum
 * registro encontrado.
 * @return string
 */
function avisoNenhumRegistroEncontrado($qtdeReg) {
   if ($qtdeReg == 0) {
      return "<p class=\"text-danger\">Nenhum registro encontrado</p>\n";
   } else {
      return '';
   }
}

/**
 * Apresenta texto explicativo sobre os filtros de pesquisa de registros.
 * @return string
 */
function avisoFiltrosPesquisa() {
	return "<p class=\"text-success\">Informe os campos desejados para realizar a pesquisa.</p>\n";
}

/**
 * Formata uma palavra ou frase em cinza claro.
 * @param string $texto
 * @return string
 */
function spnIndefinido($texto = 'Indefinido') {
   return "<span class=\"spnIndefinido\">{$texto}</span>";
}

/**
 * Criação de elemento visual indicativo referente à dica de campo de formulário.
 * @param $texto
 * @return string
 */
function campoDica($texto) {
   return "<span class=\"spnCampoDica\">{$texto}</span>";
}

function tituloCadastroFilho ($titulo, $qtdeReg = NULL) {
   echo "<h2 class=\"tituloCadastroFilho\">{$titulo}";

   if ($qtdeReg != NULL) {
      echo " <span style=\"font-size: 10pt;\">({$qtdeReg} registro" . ($qtdeReg >= 2 ? 's' : '') . ')</span> ';
   }
   
   echo "</h2>\n";
}


/** *************************************************************************
 * Geração de miniatura de arquivo JPG.
 * @param string $pastaMini Pasta onde a miniatura deve ir a partir da pasta raiz "$raizImagens"
 * @param string $pastaGrande Pasta onde a imagem grande está
 * @param string $raizImagens Pasta raiz das imagens, ou seja, antes de qualquer pasta do tipo "grande", "média", etc..
 * @param string $nomeArq Nome do arquivo
 * @param int $alturaMini Altura máxima que a miniatura pode ter
 * @param int $larguraMini Largura máxima que a miniatura pode ter
 * @return boolean
 */
function geraMiniatura($pastaMini, $pastaGrande, $raizImagens, $nomeArq, $alturaMini, $larguraMini) {
	$ret = TRUE;
	$redimencionou = FALSE;

	$maxAlturaMini = $alturaMini;
	$maxLarguraMini = $larguraMini;

	@list($larguraGrande, $alturaGrande) = getimagesize($raizImagens . "/{$pastaGrande}/" . $nomeArq);

	if ($alturaGrande >= $larguraGrande) {
		$fator       = $maxAlturaMini / $alturaGrande;
		$larguraMini = (int) ($larguraGrande * $fator);

		if ($larguraMini > $maxLarguraMini) {
			$larguraMini = $maxLarguraMini;
			$fator      = $larguraMini / $larguraGrande;
			$alturaMini = (int) ($alturaGrande * $fator);
		}
	} else {
		$fator      = $maxLarguraMini / $larguraGrande;
		$alturaMini = (int) ($alturaGrande * $fator);

		// RS 16/08/2013: Caso a altura ultrapasse o limite, seta a altura para o máximo permitido e
		// calcula a largura que ficará.
		if ($alturaMini > $maxAlturaMini) {
			$alturaMini  = $maxAlturaMini;
			$fator       = $alturaMini / $alturaGrande;
			$larguraMini = (int) ($larguraGrande * $fator);
		}
	}

	@$image_p = imagecreatetruecolor($larguraMini, $alturaMini);
	 
	$ext = pathinfo($raizImagens . "/{$pastaGrande}/" . $nomeArq, PATHINFO_EXTENSION);
	switch ($ext) {
		case 'jpg':
		case 'jpeg':
			@$image = imagecreatefromjpeg($raizImagens . "/{$pastaGrande}/" . $nomeArq);
			break;
		case 'png':
			@$image = imagecreatefrompng($raizImagens . "/{$pastaGrande}/" . $nomeArq);
			break;
	}

	if (!$image_p || !$image) {
		echo ("\n*** ERRO AO GERAR MINIATURA, POSSIVELMENTE IMAGEM DIFERENTE DE FORMATO JPG OU JPG INVALIDO ***\n");
		$ret = FALSE;
	}

	if (!imagecopyresampled($image_p, $image, 0, 0, 0, 0, $larguraMini, $alturaMini, $larguraGrande, $alturaGrande)) {
		echo ("\n*** ERRO AO ALTERAR DIMENSOES DA IMAGEM ***\n");
		$ret = FALSE;
	} else {
		if (!imagejpeg($image_p, $raizImagens . "/{$pastaMini}/" . $nomeArq, 90)) {
			echo ("\n*** ERRO AO CRIAR NOVA IMAGEM ***\n");
			$ret = FALSE;
		}
	}

	return $ret;
}
