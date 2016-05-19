$(document).ready(function() {
   $("#texNome").focus();

   $("#frmCate").submit(function() {
      var nome = $('#texNome').val() == "";
      
      if (nome) {
         alert("*** ATENÇÃO ***\n\nOs campos seguidos de asterisco ( * ) são obrigatórios.");
         return false;
      }
   });
});
