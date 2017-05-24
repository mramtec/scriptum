$(document).ready(function(){
    
    $('.message').animate({
        bottom: '2em'
    },{
        duration: 1500,
        specialEasing: {
            bottom: 'easeInOutQuint'
        }
    });
    
    setTimeout(function(){
        $('.message').animate({
            bottom: '-=18em'
        },{
            duration: 1000,
            specialEasing: {
                bottom: 'easeInOutQuint'
            }
        });
    }, 5000);
        
    
});