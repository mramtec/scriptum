$(document).ready(function(){
    
    var limitTAGS = false;
    var limitTITLE = false;
    var limitSUBTITLE = false;
    
    function OnClickMini(){
        $("#action_upload").on("click", function(){
            $("#file_miniatura").trigger("click");
        });
    }
    
    function OnClickCapa(){
        $("#action_upload_capa").on("click", function(){
            $("#file_capa").trigger("click");
        });
    }

    function loadLineBotton(element, elementVarControl){

        if(element.val().length != 0 && elementVarControl == false){
            element.parent().children('.box_inner_line2').animate({
               width: '100%'
            },{
                duration: 5400,
                specialEasing:{
                    width: 'easeInOutQuint'
                }
            });
            elementVarControl = true;
        }else if(element.val().length == 0 && elementVarControl == true){
            element.parent().children('.box_inner_line2').animate({
               width: '0%'
            },{
                duration: 3400,
                specialEasing:{
                    width: 'easeInOutQuint'
                }
            });
            elementVarControl = false;
        }

    }
    
    /*
    $("#delete_capa").on("click", function(){

        var Path = $(this).attr("data-capa");
        var ID = $(this).attr("data-post");

        $.ajax({
            url: "process/Process_Post_Edit_Ajax.php",
            method: "post",
            data: "apagar_capa=" + Path + "&apagar_post=" + ID
        }).done(function(data){
            if(data === '1'){
                $(".capa_" + ID).fadeOut("slow", function(){
                    $('.bottom_capa_inner_actions').append().html('<i id="action_upload_capa" class="fa fa-cloud-upload fa-fw"></i>');
                    OnClickCapa();
                });
            }
        }).error(function(data){
           alert("Falha na rede!");
        });

    });
    
    
    $("#delete_mini").on("click", function(){

        var Path = $(this).attr("data-mini");
        var ID = $(this).attr("data-post");

        $.ajax({
            url: "process/Process_Post_Edit_Ajax.php",
            method: "post",
            data: "apagar_mini=" + Path + "&apagar_post=" + ID
        }).done(function(data){
            if(data === '1'){
                $(".miniatura_" + ID).fadeOut("slow", function(){
                    $('#delete_mini').fadeOut('fast');
                    $('.bottom_box_inner_actions').append().html('<i id="action_upload" class="fa fa-cloud-upload fa-fw"></i>');
                    OnClickMini();
                });
            }
        }).error(function(data){
           alert("Falha na rede!");
        });

    });    
    */

    $('.titulo').keyup(function(){
        if($(this).val().length != 0){
            $('#title_section_post').text($(this).val());
        }
    });
    
    $('.postleft_box .titulo').keyup(function(){
        loadLineBotton($(this), limitTITLE); 
    });
    
    $('.postleft_box .subtitulo').keyup(function(){
        loadLineBotton($(this), limitSUBTITLE);
    });
    
    $('.postright_box .tags').keyup(function(){
        loadLineBotton($(this), limitTAGS);
    });
   
   
   /* Visualization images on post 

   $('#action_view').click(function(){
       $('.box_view_images').animate({
           right: '0%'
       },{
           duration: 750,
           specialEasing: {
               right: 'easeInOutQuint'
           }
       }, setTimeout(function(){$('.view_miniatura').fadeIn(400)}, 750));
   });
   
   
    $('#action_view_capa').click(function(){
       $('.box_view_images').animate({
           right: '0%'
       },{
           duration: 750,
           specialEasing: {
               right: 'easeInOutQuint'
           }
       }, setTimeout(function(){$('.view_capa').fadeIn(400)}, 750));
    });


    $('.box_view_images').click(function(){
       $(this).animate({
           right: '-=100%'
       },{
           duration: 600,
           specialEasing: {
               right: 'easeInOutQuint'
           }
       }, setTimeout(function(){$('.view_miniatura, .view_capa').fadeOut(400)}, 600));
    });
   */
   
    OnClickMini();
    OnClickCapa();
});