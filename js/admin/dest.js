$(document).ready(function() {
   $("#texNome").focus();

   $("#frmDest").submit(function() {
      var nome = $('#texNome').val() == "";
      var email = $('#texEmail').val() == "";
      var contato = $('#cmbEmailPaginaContato').val() == 0;
      var cadastro = $('#cmbEmailAvisoCadCliente').val() == 0;
      var avisoPedido = $('#cmbEmailAvisoPedido').val() == 0;
      var integracao = $('#cmbEmailIntegracaoCadastro').val() == 0;
      var ativo = $('#cmbAtivo').val() == 0;
      
      if (nome || email || contato || cadastro || avisoPedido || integracao || ativo) {
         alert("*** ATENÇÃO ***\n\nOs campos seguidos de asterisco ( * ) são obrigatórios.");
         return false;
      }
   });
});
