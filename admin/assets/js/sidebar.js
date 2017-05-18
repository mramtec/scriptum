$(document).ready(function(){
    
    var statusOpen = 0;
    /*
    $(window).bind('scroll', function (){
      if($(window).scrollTop() > 50){
            $('.header_color').animate({opacity: 0.5}, 500);
      }else if($(window).scrollTop() < 50){
            $('.header_color').animate({opacity: 0.0}, 500);
      }
    });
*/
    
    function OpenMenu(){

        $('.sidebar').animate({
            left: '0%'
        },{
            duration: 900,
            specialEasing:{
                left: 'easeOutCubic'
            }
        }, function(){
            
            $('.sidebar').css({
               'box-shadow' : '0 5px 8px #000',
               '-moz-box-shadow' : '0 5px 8px #000',
               '-webkit-box-shadow' : '0 5px 8px #000'
            });
        });
        
        $('.sidebar_color').animate({
            left: '0%'
        },{
            duration: 800,
            specialEasing:{
                left: 'easeOutCubic'
            }
        }, 250);
        
        
        statusOpen = 1;
        
    }
    
    
    function CloseMenu(){
    
        var WidthScreen = $(window).width();
        var HideLeft = '-15%';

        if(WidthScreen <= 640){
            HideLeft = '-45%';
        }
    
        $('.sidebar').animate({
            left: HideLeft
        },{
            duration: 900,
            specialEasing:{
                left: 'easeOutCubic'
            }
        }, 800, function(){
            $('.sidebar').css({
               'box-shadow' : 'none',
               '-moz-box-shadow' : 'none',
               '-webkit-box-shadow' : 'none'
            });
        });
        
        $('.sidebar_color').animate({left: '-100%'},{
            duration: 800,
            specialEasing:{
                left: 'easeOutCubic'
            }
        }, 300);
        statusOpen = 0;
    }
    
    
    $('.menu_btn').click(function(){
        
        if(statusOpen == 0){
            OpenMenu();
        }else{
            CloseMenu();
        }
    });
    
    
    $('.sidebar_color').click(function(){
        var WidthScreen = $(window).width();
        
        if(statusOpen == 1){
            CloseMenu();
        }
    });
    
    
    $(document).on('swiperight', function(){
        var WW = $(window).width();

        if(statusOpen == 0 && WW <= 1300){
            OpenMenu();
        }
            
    });
    
    $(document).on('swipeleft', function(){
        var WW = $(window).width();
        if(statusOpen == 1 && WW <= 1300){
            CloseMenu();
        }
    });
    
    $('aside ul li').hover(
        function(){
            $(this).children('.asideload').animate({
                width: '100%'
            }, {
                duration: 800,
                specialEasing:{
                    width: 'easeOutCubic'
                }
            });
        },
        function(){
            $(this).children('.asideload').animate({
                width: '0%'
            }, {
                duration: 500,
                specialEasing:{
                    width: 'easeInCubic'
                }
            });
        }
    );

});
