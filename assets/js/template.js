$(function(){
    $('.menufixo').hide();
});

$(function(){
    var hs = $('.conteudo').height();
    $('.botaomenu').on('click',function(){
        //$('.menufixo').css('height',hs);
        $('.menufixo').height($('.conteudo').height());
        $('.submenu').children('ul').slideUp('fast');
        $('.menufixo').toggle('fast', function(){
            if($(".menufixo").is(':visible')){
                $('.botaomenu').children('img').attr('src',baselink+'/assets/images/x.png');
            }else{
                $('.botaomenu').children('img').attr('src',baselink+'/assets/images/menu.png');
            }
        }); 
    });
}); 

$(function(){
    $('.submenu').on('click',function(){
        $('.submenu').children('ul').slideUp('fast, duration: 500');
        $(this).children('ul').slideDown('fast, duration: 500');
    });
}); 

$(function(){
    var link = $('.menufixo a').attr('href');
    if( link !== '#'){
        $('.botaomenu').on('click');
    }
}); 

$(function(){
   $(window).on('click',function(e){
        var mouseX = e.originalEvent.pageX;
//        if(mouseX > 320 & $(".menufixo").is(':visible')){
//           $('.botaomenu').on('click'); 
//        }
        if(mouseX > 320){
            if($(".menufixo").is(':visible')){
//                console.log(mouseX);
                $('.botaomenu').click();
            }    
        }    
    });    
});