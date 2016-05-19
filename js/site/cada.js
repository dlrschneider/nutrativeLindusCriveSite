$(document).ready(function() {
   $('#texCnpj').mask('?99.999.999/9999-99');
   $('#texCep').mask('?99999-999');
   $('#texFone').mask('?(99) 9999-9999');
   $('#texRazaoSocial').focus();
   
   $('#btnCadastra').click(function() {
      this.value = "Aguarde...";
      this.disabled = true;
   });

   $('#chkIsento').change(function() {
      if ($('#chkIsento').is(':checked')) {
         $('#texIE').prop("disabled", true);
         $('#texIE').val('');
      } else {
         $('#texIE').prop("disabled", false);
         $('#texIE').val('');
      }
   });
   
});