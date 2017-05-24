$(document).ready(function(){

    $('#busca').keyup(function(){

        $(".close").fadeIn(300);
        var buscaBox = $('#busca').val();
        if($("#busca").val() == ""){
            $(this).val('');

            $('.resultados ul').empty();

            $('.busca').css({
                'border-bottom-left-radius' : '4px',
                'border-bottom-right-radius' : '4px'
            });

        }else{
            $.post( 
                "process/Process_Users_Ajax.php", 
                {search:buscaBox},
                function(data){
                    $('.busca').css({
                        'border-bottom-left-radius' : '0',
                        'border-bottom-right-radius' : '0'
                    });
                    $('.resultados ul').append().html(data);
                }
            );
        }

    });
	$('body').click(function(){
		$('.resultados ul li').fadeOut(200);
	});
	$('.close').click(function(){
		$('.resultados ul li').fadeOut(200);
	});
        
        
    $('#novo_usuario').click(function(){

        $('.box_convite').animate({
            right: '0%'
        }, {
            duration: 600,
            specialEasing: {
                right: 'easeOutCubic'
            }
        },  setTimeout(function(){
                $('.box_convite_form').fadeIn(400);
            }, 600)
        );

    });


    $('.box_convite_color').click(function(){
        $('.box_convite_form').fadeOut(300, function(){
            $('.box_convite_color').animate({
                right: '-=100%'
            }, {
                duration: 500,
                specialEasing: {
                    right: 'easeOutCubic'
                }
            }, setTimeout(function(){
                    $('.box_convite').animate({right: '-=100%'}, 300);
            }, 500)
            );
        });
    });


    function load_bg_style(){
        $('.box_post').hover(

            function(){                            
                var child_bg = $(this).children().hasClass("bg");

                if(child_bg){
                    $(this).css("color", "#fff").find(".color, .bg").animate({
                        opacity: 1.0
                    }, 400);

                    $(this).find(".box_post_right, .box_post_right a").css("color", "#fff");
                }
            },
            function(){
                var child_bg = $(this).children().hasClass("bg");

                if(child_bg){
                    $(this).css("color", "#545454").find(".color, .bg").animate({
                        opacity: .0
                    }, 400);

                    $(this).find(".box_post_right, .box_post_right a").css("color", "#545454");
                }
            }
        );
    }

    function alterarPrivilegio(){
        $('.box_post_left').on("click", function(){
            var userID = $(this).find('#acesso_privilegio').attr('data-id');

            $.ajax({
                url: 'process/Process_Users_Ajax.php',
                method: 'post',
                data: 'alterar_privilegio=' + userID
            }).done(function(data){
                $('#rotulo_' + userID).text(data);
            });
        });
    }

    function alterarAcesso(){
        $('.lock').on('click', function(){

            var userID = $(this).find('.fa').attr('data-id');

            $.ajax({
                url: 'process/Process_Users_Ajax.php',
                method: 'post',
                data: 'acesso=' + userID
            }).done(function(data){
                if(data == 'lock'){
                    $('#' + userID + '_lock').children('.fa').removeClass('fa-unlock').addClass('fa-lock');
                }else if(data == 'unlock'){
                    $('#' + userID + '_lock').children('.fa').removeClass('fa-lock').addClass('fa-unlock');
                }
            });
        });                    
    }

    function load_delete_content(){
        $('.delete_item').on("click", function(){
            var dataID = $(this).find("#delete").attr("data-delete-id");
            var dataCapa = $(this).find("#delete").attr("data-delete-capa");
            var dataPerfil = $(this).find("#delete").attr("data-delete-perfil");

            $.ajax({
               method: "post",
               url: "process/Process_Users_Ajax.php",
               data: "delete_user=" + dataID + "&delete_capa=" + dataCapa + "&delete_perfil=" + dataPerfil
            }).done(function(data){
                if(data == "true"){
                    $("#post_" + dataID).animate({
                        opacity: .0,
                        height: "0px"
                    }, 500);
                }else{
                    alert(data);
                }
            }).error(function(err){
                alert(err);
            });
        });
    }


    function load(instruct){
        $.ajax({
            method: "post",
            url: "process/Process_Users_Ajax.php",
            data: instruct
            }).done(function(data){
                if(data != "false"){
                    $('.posts ul').append(data);
                    load_delete_content();
                    load_bg_style();
                    alterarPrivilegio();
                    alterarAcesso();
                }else{
                    $('.load').fadeOut(500, function(){
                        $('.box_load h8').show("drop", {direction: "down"}, 500);
                    });

                }
            });
    }

   var offset = 0;
   load("offset=" + offset);

   $('.load').on('click', function(){
       offset += 4;
      load("offset=" + offset); 
   });        

});
