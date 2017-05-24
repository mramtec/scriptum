$(document).ready(function(){
    
    
    $(".click").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 1500);
    });
    
    setTimeout(function(){
        $('body, html').animate({
            scrollTop: $('header').innerHeight() + 50
        }, 2000);
    }, 700);
});