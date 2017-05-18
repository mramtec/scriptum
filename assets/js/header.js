$(document).ready(function(){
    
    var boxSearchStatus = false;
    
    $(window).bind("scroll", function (){
        
        if($(this).scrollTop() > $('header').innerHeight()){
            $('.navbar').css('top', '0em');

        }else if($(this).scrollTop() < $('header').innerHeight()){
            $('.navbar').css('top', '-7em');
        }
    });
    
    
    function bounceHeader(){
        setInterval(function(){
            $(".header_bottom").effect("bounce", { times: 1 }, 1500);
        }, 5000);
    }


    $(".navbar_search, .header_search > img").click(function(){       
        if(boxSearchStatus == false){
            $('.search').animate({
                left: "0%",
                opacity: 1.0
            }, 350, function(){
                $(".search_inner_input").focus();
            });
            
            boxSearchStatus = true;
        
        }
    });
    
    $('.search_color').click(function(){
        if(boxSearchStatus == true){
            $('.search').animate({
                left: '-100%',
                opacity: 0.0
            },300);
            boxSearchStatus = false;
        }
    });

    $("header").hover(
        function(){
            $(".header_color").css('background' , 'rgba(10, 104, 119, 0.4)');
        },
        function(){
            $(".header_color").css('background' , 'rgba(0, 0, 0, 0.5)');
        }
    );

    bounceHeader();

});