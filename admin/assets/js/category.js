$(document).ready(function(){

    $('#open_file').click(function(e){
        e.preventDefault();
        $('#file').trigger('click');
    });

    function deleteCat(){
        $(document).on('click', '#delete', function(){

            var data = $(this).attr('data-id');

            $.ajax({
                url: 'process/Process_Category_Ajax.php',
                method: 'post',
                data: 'delete=' + data
            }).done(function(retorno){
                if(retorno == 1){
                    $('#cat_' + data).hide('drop', {direction: 'down'}, 350);
                }
            });
                
        });
    }
    
    
    function loadCategory(instruct){
       
       $.ajax({
           url: 'process/Process_Category_Ajax.php',
           method: 'post',
           data: instruct
       }).done(function(data){
           if(data == 0){
                $('.load').text('').text('Fim').PreventDefault();
           }else{
                $('.box1_right_list').append(data); 
                deleteCat();
           }
          
       }); 
    }

    var offset = 0;
    var statusSubmit = false;
    loadCategory('offset=' + offset);
    
    $('#titulo').keyup(function(){
        $(this).css({
           'border' : '1px #ddd solid',
            'box-shadow' : 'none',
            '-moz-box-shadow' : 'none',
            '-webkit-box-shadow' : 'none'
        });
    });
    
    /*
   $("#criar").click(function(){
        
        statusSubmit = true;
        $('#criar').text('Enviando...');

        $('#post').submit(function(){
            var titulo = $('#titulo').val();
            var descricao = $('#descricao').val();

            if(titulo.length == 0){
                $('#titulo').css({
                    'border' : '1px red solid',
                    'box-shadow' : '1px 1px 3px #989898',
                    '-moz-box-shadow' : '1px 1px 3px #989898',
                    '-webkit-box-shadow' : '1px 1px 3px #989898'
                });
                return false;
            }else{
                
                if(statusSubmit == true){
                    
                    $('#criar').hide('drop', {direction: 'down'}, 500);
                    
                    $.ajax({
                        url: 'process/Process_Category_Ajax.php',
                        method: 'post',
                        data: 'criar=1&titulo=' + titulo + '&descricao=' + descricao,
                        cache: false,
                        timeout: 500
                    }).done(function(data){

                        if(data == 1){
                            $('#titulo').val('');
                            $('#descricao').val('');
                            $('.box1_right ul li').remove();
                            setTimeout(function(){
                                var offset = 0;
                                loadCategory('offset=' + offset);    
                            }, 750);
                            
                            $('#criar').text('Criar');
                            
                            $('#criar').show('drop', {direction: 'down'}, 500);
                        }
                    });
                    statusSubmit = false;
                }
            }
            
            return false;
        }); 
    }); */


   $('.load').click(function(){
       offset += 8;
       loadCategory('offset=' + offset);
   });
   
});