$(document).ready(function(){

    $('#busca').keyup(function(){

        $(".close").fadeIn(300);
        var buscaBox = $('#busca').val();
        if($("#busca").val() == ""){
            $(this).val('');

            $('.resultados ul').empty();

            $('.busca').css({
                'border-bottom-left-radius' : '4px',
                'border-bottom-right-radius' : '4px',
                'border' : '1px #0a6877 solid'
            });

        }else{
            $.post( 
                "process/Process_Post_Read.php", 
                {search:buscaBox},
                function(data){
                    $('.busca').css({
                        'border-bottom-left-radius' : '0',
                        'border-bottom-right-radius' : '0',
                        'border' : '1px #333 solid'
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
        
        

        function load_bg_style(){
            $('.box_post').hover(

                function(){                            
                    var child_bg = $(this).children().hasClass("bg");

                    if(child_bg){
                        $(this).css("color", "#fff").find(".color, .bg").animate({
                            opacity: 1.0
                        }, 200);

                        $(this).find(".box_post_right, .box_post_right a").css("color", "#fff");
                    }
                },
                function(){
                    var child_bg = $(this).children().hasClass("bg");

                    if(child_bg){
                        $(this).css("color", "#545454").find(".color, .bg").animate({
                            opacity: .0
                        }, 200);

                        $(this).find(".box_post_right, .box_post_right a").css("color", "#545454");
                    }
                }
            );
        }


        function load_publish_now(){
            $('.box_post_right').on("click", function(){

                var data_publish = $(this).find("#publicar_agora").attr("data-agenda-id");

                if(data_publish != null && data_publish != "undefined"){
                    $.ajax({
                        method: "post",
                        url: "process/Process_Post_Read.php",
                        data: "publish=" + data_publish
                    }).done(function(data){
                        if(data == "true"){
                            $("#publish_" + data_publish).fadeOut(450, function(){
                               $("#publish_hide_" + data_publish).show("drop", {direction: "down"}, 500);
                            });
                        }
                    });            
                }
            });
        }


        function load_delete_content(){
            $('.delete_item').on("click", function(){
                var data_id = $(this).find("#delete").attr("data-delete-id");
                var data_capa = $(this).find("#delete").attr("data-delete-capa");
                var data_miniatura = $(this).find("#delete").attr("data-delete-miniatura");

                $.ajax({
                   method: "post",
                   url: "process/Process_Post_Read.php",
                   data: "delete_post=" + data_id + "&delete_capa=" + data_capa + "&delete_miniatura=" + data_miniatura
                }).done(function(data){
                    if(data == "true"){
                        $("#post_" + data_id).animate({
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
                url: "process/Process_Post_Read.php",
                data: instruct
                }).done(function(data){
                    if(data != "false"){
                        $('.posts ul').append(data);
                        load_delete_content();
                        load_bg_style();
                        load_publish_now();
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
