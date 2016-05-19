$(document).ready(function() {
   $('#texCnpj').mask('?99.999.999/9999-99');
   $('#texRazaoSocial').focus();
   
   $('#btnCadastra').click(function() {
      this.value = "Aguarde...";
      this.disabled = true;
      $('#frmPrecad').submit();
   });
});