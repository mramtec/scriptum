$(document).ready(function(){
    
    $("#action_upload_profile").on('click', function(e){
        e.preventDefault();
       $("#file_profile").trigger("click");
       
    });
    
    $('#file_profile').change(function(){
        $('#form_profile').submit();
    });
    
    $("#action_upload_capa").click(function(e){
        e.preventDefault();
       $("#file_capa").trigger("click");
    });

    $('#file_capa').change(function(){
        $('#form_capa').submit();
    });
    

    $(".senha").keyup(function(){
        var pass = $(this).val();
        
        if(pass.length == 0){
            $('.fa-lock').css({
                "color" : "#134374",
                "text-shadow" : "none"
            });
        }else if(pass.length < 6){
            $('.fa-lock').css({
                "color" : "lightcoral"
            });
        }else if(pass.length >= 6 && pass.length <= 8){
            $('.fa-lock').css({
                "color" : "gold"
            });
        }else if(pass.length >= 8){
            $('.fa-lock').css({
                "color" : "limegreen",
                "text-shadow" : "0 0 2px limegreen"
            });
        }
    });
    

});
