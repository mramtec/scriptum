$(document).ready(function(){
            
    function HoverGrid(){
        $(".box1_grid_inner").hover(
            function(){
                $(this).children(".box1_grid_inner_color").animate({
                    top: '-100%'
                }, 300);
                $(this).children(".box1_grid_inner_color2").animate({
                    top: '0%'
                }, 300);
            },
            function(){
                $(this).children(".box1_grid_inner_color").animate({
                    top: '0%'
                }, 300);
                $(this).children(".box1_grid_inner_color2").animate({
                    top: '100%'
                }, 300);
            }
        );
    }
    
    function HoverGrid3(){
        $(".box3_grid_inner").hover(
            function(){
                $(this).children(".box3_grid_inner_color").animate({
                    top: '-100%'
                }, 300);
                $(this).children(".box3_grid_inner_color2").animate({
                    top: '0%'
                }, 300);
            },
            function(){
                $(this).children(".box3_grid_inner_color").animate({
                    top: '0%'
                }, 300);
                $(this).children(".box3_grid_inner_color2").animate({
                    top: '100%'
                }, 300);
            }
        );
    }
    
    
    function loadpost(offset){

       $.ajax({
           url: "ajax/ajax_index.php",
           method: "post",
           data: "offset="+offset
       }).done(function(data){
           if(data != 0){
                $(".box1").append(data);
                HoverGrid();
            }else{
                $('.box1_btn button').fadeOut(350);
            }
       });

   }

   var offset = 0;
   loadpost(offset);
   HoverGrid3();
   
   $('.box1_btn button').click(function(){
       offset += 6;
       loadpost(offset);
   });
});