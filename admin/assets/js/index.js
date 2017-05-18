$(document).ready(function(){

    function loadEDIT(){
        $('.box2_grid_inner').hover(function(){
           $(this).find('.fa').fadeIn(200); 
        }, function(){
           $(this).find('.fa').fadeOut(200); 
        });
    }

    function loadPost(instrucao){

        $.ajax({
            method : 'POST',
            url : 'ajax/ajax_index_loads.php',
            data : instrucao
        }).done(function( content ){

            if(content != '0'){
              $('.box2').append( content );
                loadEDIT();
            }else{
              $('.more').fadeOut(600, function(){ $('.endload').fadeIn(600); });
            }
        });
    }

    var offset = 0;
    loadPost( "offset=" + offset );

    $('.more').click(function(){
        offset += 8;
        loadPost("offset=" + offset );
    });

});