<div id="containerConteudo" class="container">
<?php
echo tituloCadastro('Not�cias');

echo $msg;

echo '<p>' . botaoLocation('btCadastro', 'Not�cias', 'nutri/noti') . ' ';

if ($id) {
   echo botaoLocation('btAltera', 'Alterar not�cia', "nutri/noti/form/{$id}") . ' ';
}

echo botaoLocation('btNovo', 'Nova not�cia', 'nutri/noti/form') . "</p>\n";
?>
</div>