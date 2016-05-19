$(document).ready(function() {
   $("#texNome").focus();

   $("#frmSubc").submit(function() {
      var categoria = $('#cmbCategoria').val() == 0;
      var nome = $('#texNome').val() == "";
      
      if (categoria || nome) {
         alert("*** ATENÇÃO ***\n\nOs campos seguidos de asterisco ( * ) são obrigatórios.");
         return false;
      }
   });
});
