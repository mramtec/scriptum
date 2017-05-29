$(document).ready(function(){
    
    $('#archive').click(function(e){
        e.preventDefault();
        $('.capa').trigger('click');
    });
    
    $('#adicionar').click(function(){
        
       $('.box').animate({
           left: '0%'
       },{
           duration: 900,
           specialEasing:{
               left: 'easeInOutQuint'
           }
       },
           setTimeout(function(){ $('.box_inner').fadeIn(400); }, 900)
       );
    });
    
    $('.box_color').click(function(){
       $('.box').animate({
           left: '100%'
       },{
           duration: 900,
           specialEasing:{
               left: 'easeInOutQuint'
           }
       },
           setTimeout(function(){ $('.box_inner').fadeOut(400); }, 500)
       ); 
    });
    
    
    function excluir(){
        
        $(document).on('click', '#excluir' ,function(){
            var ID = $(this).attr('data-id');
            var Path = $(this).attr('data-path');
            
            $.ajax({
                url: 'process/Process_Slide.php',
                method: 'POST',
                data: 'delete=' + ID + '&delete-archive=' + Path
            }).done(function(data){

                $('#item_' + ID).hide('drop', {direction: 'down'}, 850);
                
            });
            
        });

    }
    

    function LoadListSlide(){

        $.ajax({
            url: 'process/Process_Slide.php',
            method: 'POST',
            data: 'list=true'
        }).done(function(data){
            
            $('.box1').append(data);
            excluir();

        });

    }


    LoadListSlide();

});