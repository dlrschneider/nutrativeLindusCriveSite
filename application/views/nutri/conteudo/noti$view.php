<div id="containerConteudo" class="container">
<?php
echo tituloCadastro('Notícias');

echo $msg;

echo '<p>' . botaoLocation('btCadastro', 'Notícias', 'nutri/noti') . ' ';

if ($id) {
   echo botaoLocation('btAltera', 'Alterar notícia', "nutri/noti/form/{$id}") . ' ';
}

echo botaoLocation('btNovo', 'Nova notícia', 'nutri/noti/form') . "</p>\n";
?>
</div>