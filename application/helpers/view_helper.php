<?php

/**
 * Gera botão HTML "submit" de confirmação de formulário.
 * @param string $class Nome da classe CSS do botão.
 * @param boolean $disabled TRUE-Botão desabilitado, FALSE-Botão habilitado.
 * @version 1.0.1
 * @return string Elemento HTML "input" do botão criado.
 */
function botaoConfirmar($class = 'btn btn-warning btn-sm', $disabled = FALSE) {
   return '<input class="' . $class . '" style="font-weight: bold;" type="submit" ' . ($disabled ? 'disabled="disabled" style="cursor: not-allowed;" ' : '') . 'name="btConfirma" id="btConfirma" value="Confirmar" />';
}

/**
 * Gera botão HTML "input" de cancelar operação/formulário.
 * @param $locationOnclick
 * @return string
 */
function botaoCancelar($locationOnclick, $value = "Cancelar") {
   return "<input class=\"btn btn-default btn-sm\" type=\"button\" name=\"btCancela\" id=\"btCancela\" value=\"{$value}\" onclick=\"window.location.href='" . site_url() . '/' . $locationOnclick . '\';" />';
}

/**
 * Cria um botão padrão com opção de onclick.
 * @param string $nomeId
 * @param string $value
 * @param string $locationOnclick
 * @return string Elemento HTML do botão criado.
 */
function botaoLocation($nomeId, $value, $locationOnclick, $class = 'btn btn-default btn-sm') {
   return form_input(array(
   'type' => 'button',
   'name' => $nomeId,
   'id' => $nomeId,
   'value' => $value,
   'class' => $class,
   'onclick' => 'window.location.href=\'' . site_url() . '/' . $locationOnclick . '\''));
}

/**
 * Cria o botão de submissão padrão de pesquisa de registros.
 * @param string $jsOnClick
 * @version 1.0.0
 * @return string
 */
function botaoPesquisar($jsOnClick = NULL, $type = "submit") {
   return "<button type=\"{$type}\" class=\"btn btn-default btn-sm\" name=\"btnPesquisa\" value=\"btnPesquisa\" title=\"Clique para realizar a pesquisa conforme os filtros informados\""
   . ($jsOnClick ? " onclick=\"{$jsOnClick}\"" : '') . ">"
         . "Pesquisar</button>";
}

/**
 * Cria o botão padrão de limpar filtros de pesquisa.
 * @param string $jsOnClick
 * @version 1.0.0
 * @return string
 */
function botaoLimparFiltros($jsOnClick = NULL) {
   $js = ($jsOnClick ? " onclick=\"{$jsOnClick}\"" : '');
   return "<button type=\"submit\" class=\"btn btn-default btn-sm\" name=\"btnLimparFiltros\" title=\"Clique para limpar os filtros de pesquisa\" "
         . "value=\"btnLimparFiltros\"{$js}>"
   . "Limpar Filtros</button>";
}

/**
 * Criação de elemento visual indicativo de campo obrigatório (co).
 * @return string
 */
function co() {
   return '<span class="spnCO">*</span>';
}

/**
 * Monta comboBox de seleção de estados (unidades federativas do Brasil).
 * @param string  $nomeId
 * @param string  $selecao
 * @param boolean $disabled
 * @param string  $textoPadrao
 * @version 1.0.2
 * @return void
 */
function comboEstado($nomeId, $selecao, $disabled = FALSE, $textoPadrao = 'Selecione', $class = "form-control") {
   echo "<select name=\"{$nomeId}\" id=\"{$nomeId}\" class=\"{$class}\" " . ($disabled ? ' disabled="disabled"' : '') . ">\n"
   . "<option value=\"\"" . ($selecao == '' ? " selected=\"selected\"" : '') . ">{$textoPadrao}</option>\n"
   . "<option value=\"AC\"" . ($selecao == 'AC' ? " selected=\"selected\"" : '') . ">Acre</option>\n"
   . "<option value=\"AL\"" . ($selecao == 'AL' ? " selected=\"selected\"" : '') . ">Alagoas</option>\n"
   . "<option value=\"AP\"" . ($selecao == 'AP' ? " selected=\"selected\"" : '') . ">Amapá</option>\n"
   . "<option value=\"AM\"" . ($selecao == 'AM' ? " selected=\"selected\"" : '') . ">Amazonas</option>\n"
   . "<option value=\"BA\"" . ($selecao == 'BA' ? " selected=\"selected\"" : '') . ">Bahia</option>\n"
   . "<option value=\"CE\"" . ($selecao == 'CE' ? " selected=\"selected\"" : '') . ">Ceará</option>\n"
   . "<option value=\"DF\"" . ($selecao == 'DF' ? " selected=\"selected\"" : '') . ">Distrito Federal</option>\n"
   . "<option value=\"ES\"" . ($selecao == 'ES' ? " selected=\"selected\"" : '') . ">Espírito Santo</option>\n"
   . "<option value=\"GO\"" . ($selecao == 'GO' ? " selected=\"selected\"" : '') . ">Goiás</option>\n"
   . "<option value=\"MA\"" . ($selecao == 'MA' ? " selected=\"selected\"" : '') . ">Maranhão</option>\n"
   . "<option value=\"MT\"" . ($selecao == 'MT' ? " selected=\"selected\"" : '') . ">Mato Grosso</option>\n"
   . "<option value=\"MS\"" . ($selecao == 'MS' ? " selected=\"selected\"" : '') . ">Mato Grosso do Sul</option>\n"
   . "<option value=\"MG\"" . ($selecao == 'MG' ? " selected=\"selected\"" : '') . ">Minas Gerais</option>\n"
   . "<option value=\"PA\"" . ($selecao == 'PA' ? " selected=\"selected\"" : '') . ">Pará</option>\n"
   . "<option value=\"PB\"" . ($selecao == 'PB' ? " selected=\"selected\"" : '') . ">Paraíba</option>\n"
   . "<option value=\"PR\"" . ($selecao == 'PR' ? " selected=\"selected\"" : '') . ">Paraná</option>\n"
   . "<option value=\"PE\"" . ($selecao == 'PE' ? " selected=\"selected\"" : '') . ">Pernambuco</option>\n"
   . "<option value=\"PI\"" . ($selecao == 'PI' ? " selected=\"selected\"" : '') . ">Piauí</option>\n"
   . "<option value=\"RJ\"" . ($selecao == 'RJ' ? " selected=\"selected\"" : '') . ">Rio de Janeiro</option>\n"
   . "<option value=\"RN\"" . ($selecao == 'RN' ? " selected=\"selected\"" : '') . ">Rio Grande do Norte</option>\n"
   . "<option value=\"RS\"" . ($selecao == 'RS' ? " selected=\"selected\"" : '') . ">Rio Grande do Sul</option>\n"
   . "<option value=\"RO\"" . ($selecao == 'RO' ? " selected=\"selected\"" : '') . ">Rondônia</option>\n"
   . "<option value=\"RR\"" . ($selecao == 'RR' ? " selected=\"selected\"" : '') . ">Roraima</option>\n"
   . "<option value=\"SC\"" . ($selecao == 'SC' ? " selected=\"selected\"" : '') . ">Santa Catarina</option>\n"
   . "<option value=\"SP\"" . ($selecao == 'SP' ? " selected=\"selected\"" : '') . ">São Paulo</option>\n"
   . "<option value=\"SE\"" . ($selecao == 'SE' ? " selected=\"selected\"" : '') . ">Sergipe</option>\n"
   . "<option value=\"TO\"" . ($selecao == 'TO' ? " selected=\"selected\"" : '') . ">Tocantins</option>\n"
   . "</select>\n";
}

/**
 * Imprime o html gerado a partir dos métodos ajax
 * @param string $html
 * @return void
 */
function imprimeHtmlAjax($html) {
   header("Content-Type: text/html; charset=ISO-8859-1");
   echo $html;
}
