$(document).ready(function(){
                
    var status = 0;
    var total = 255;
    var restante = 0;

    

    function openCount(){
        if(status == 0){
            setTimeout(function(){
                $('#count').show('drop', {direction: 'down'}, 300);
            }, 200);
        }
    }


    function closeCount(){
        if(status == 1){
            setTimeout(function(){
                $('#count').hide('drop', {direction: 'down'}, 300);
            }, 200);
        }
    }


    $('#textarea').keyup(function(){

       var lengthText = $(this).val();

       if(lengthText.length == 0){
            $('#count').text('');
            closeCount();
       }else{
           restante = total - lengthText.length;
           $('#count').text("Restam " + restante);
           openCount();
       }

    });


    $('.senha').keyup(function(){

        var senha = $(this).val().length;

        if(senha === 0)
            $('.senha').css('border-bottom', '2px #2d6684 solid');
        else if(senha < 6)
            $('.senha').css('border-bottom', '2px lightcoral solid');
        else if(senha === 6)
            $('.senha').css('border-bottom', '2px gold solid');
        else if(senha >= 6)
            $('.senha').css('border-bottom', '2px limegreen solid');
        
    });


    $('.senha2').keyup(function(){
        
        var senha1 = $('.senha').val();
        var senha2 = $(this).val();
        
        if(senha1 !== senha2)
            $('.senha2').css('border-bottom', '2px lightcoral solid');
        else
            $('.senha, .senha2').css('border-bottom', '2px limegreen solid');
        
    });


    $('.button').click(function(){
        
        $('#form').submit(function(){
            
            var nome = $('.nome');
            var nomeValue = $('.nome').val();
            var apelido = $('.apelido');
            var apelidoValue = $('.apelido').val();
            var senha = $('.senha2');
            var senhaValue = $('.senha2').val();

            if(nomeValue.length == 0){
                nome.css('border-bottom', '2px #ee5555 solid');
                return false;
            }

            if(apelidoValue.length == 0){
                apelido.css('border-bottom', '2px #ee5555 solid');
                return false;
            }

            if(senhaValue.length < 6){
                senha.css('border-bottom', '2px #ee5555 solid');
                return false;
            }
        });

    });
});