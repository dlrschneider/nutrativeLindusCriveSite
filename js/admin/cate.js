$(document).ready(function() {
   $("#texNome").focus();

   $("#frmCate").submit(function() {
      var nome = $('#texNome').val() == "";
      
      if (nome) {
         alert("*** ATEN��O ***\n\nOs campos seguidos de asterisco ( * ) s�o obrigat�rios.");
         return false;
      }
   });
});
