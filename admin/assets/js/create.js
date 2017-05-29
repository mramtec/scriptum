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
   

    OnClickMini();
    OnClickCapa();
});