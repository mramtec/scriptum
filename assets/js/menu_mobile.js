$(function(){
    
    var openMenuBool = false;
    
    function menuOpen(){
        if(openMenuBool == false){
            $(".menu_mobile").animate({
                left: '0%'
            }, 400);

            $(".menu_exit_color").animate({
                left: '+=100%'
            }, 300);

            openMenuBool = true;
        }
    }
    
    function menuClose(){
        if(openMenuBool == true){
            $(".menu_mobile").animate({
                left: '-=50%'
            }, 300);

            $(".menu_exit_color").animate({
                left: '-=100%'
            }, 400);
            
            openMenuBool = false;
        }
    }
    
    $(".menu_btn").click(function(){ menuOpen(); });
    
    $('.menu_exit_color').click(function(){ menuClose(); });
    
    
    $(document).on("swiperight",function(){
        var windowWidth = $(window).width();
        
        if(windowWidth <= 1024 && openMenuBool == false){
            menuOpen();
        }
    });
    
    $(document).on("swipeleft",function(){
        var windowWidth = $(window).width();
        
        if(windowWidth <= 1024 && openMenuBool == true){
            menuClose();
        }
    });
});
    