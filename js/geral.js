$(document).ready(function() {
   // RS 13/04/2015: Função para funcionamento das abas. ~Bootstrap apenas ajuda com o estilo das abas.~
	
   $(".nav-tabs li").click(function(){
      $('.boxAba').css('display', 'none');
      $('.nav-tabs li').removeClass('active');
      $(this).addClass('active');
      $("#" + $(this).attr('aba')).css('display', 'inline');
   });
   
   //Faz com que a lateral fique grudada ao topo, forçadamente!
   $('#bgLateral').css('position', 'relative');
   $('#bgLateral').css('top', '-10px');
   $('#bgTopo').css('position', 'relative');
   $('#bgTopo').css('top', '-5px');
});

function modalLogin(){
    if($('#modLogin').hasClass('ativo')){
        $('#modLogin').stop(true).slideUp();
        $('#modLogin').removeClass('ativo');
        $('#bgTopo .right .login').removeClass('active');
    }else{
        $('#modLogin').addClass('ativo');
        $('#bgTopo .right .login').addClass('active');
        $('#modLogin').stop(true).slideDown();
        $('input[name=login1]').focus();
    }
}

function modalNav(){
    if($('#modNav').hasClass('ativo')){
        $('#modNav').stop(true).slideUp();
        $('#modNav').removeClass('ativo');
        $('#bgLateral').css('position', 'relative');
        $('#bgLateral .menu').removeClass('active');
    }else{
        $('#modNav').addClass('ativo');
        $('#bgLateral .menu').addClass('active');
        $('#modNav').stop(true).slideDown();
        $('#bgLateral').css('position', 'static');
        $('input[name=login1]').focus();
    }
}

function modalSetting(){
    if($('#modSetting').hasClass('ativo')){
        $('#modSetting').stop(true).slideUp();
        $('#modSetting').removeClass('ativo');
        $('#bgTopo').css('position', 'relative');
        $('#bgTopo').css('top', '-5px');
        $('#bgTopo .setting .modSetting').removeClass('active');
    }else{
        $('#modSetting').addClass('ativo');
        $('#bgTopo .setting .modSetting').addClass('active');
        $('#modSetting').stop(true).slideDown();
        $('#bgTop').css('position', '');
        $('#bgTop').css('top', '');
        $('input[name=login1]').focus();
    }
}
