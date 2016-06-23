<div id="containerConteudo" class="container">
<?php
echo tituloCadastro('Clientes');

echo $msg;

echo '<p>' . botaoLocation('btCadastro', 'Nutricionistas', 'admin/nutr') . ' ';

echo botaoLocation('btAltera', 'Alterar nutricionista', "admin/nutr/form/{$id}") . ' ';
?>
</div>