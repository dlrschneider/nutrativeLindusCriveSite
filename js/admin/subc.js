$(document).ready(function() {
   $("#texNome").focus();

   $("#frmSubc").submit(function() {
      var categoria = $('#cmbCategoria').val() == 0;
      var nome = $('#texNome').val() == "";
      
      if (categoria || nome) {
         alert("*** ATEN��O ***\n\nOs campos seguidos de asterisco ( * ) s�o obrigat�rios.");
         return false;
      }
   });
});
