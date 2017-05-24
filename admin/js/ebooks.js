$(document).ready(function(){

    $('#busca').keyup(function(){

        $(".close").fadeIn(300);
        var buscaBox = $('#busca').val();

        if($("#busca").val() == ""){
            $(this).val('');
            $('.resultados ul').empty();
        }else{
            $.ajax({
                url: "process/Process_Book_Ajax.php",
                data: 'busca=' + buscaBox,
                method: 'post'
            }).done(function(data){
                $('.resultados ul').append().html(data);
            });
        }
    });
        

    $('body').click(function(){ $('.resultados ul li').fadeOut(200); });
    $('.close').click(function(){ $('.resultados ul li').fadeOut(200); });

});
