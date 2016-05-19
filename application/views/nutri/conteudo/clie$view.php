<div id="containerConteudo" class="container">
<?php
echo tituloCadastro('Clientes');

echo $msg;

echo '<p>' . botaoLocation('btCadastro', 'Clientes', 'nutri/clie') . ' ';

if ($id) {
   echo botaoLocation('btAltera', 'Alterar cliente', "nutri/clie/form/{$id}") . ' ';
}

echo botaoLocation('btNovo', 'Novo cliente', 'nutri/clie/form') . "</p>\n";
?>
</div>