$(document).ready(function(){

    $('#open_file').click(function(e){
        e.preventDefault();
        $('#file').trigger('click');
    });

    $('#titulo').keyup(function(){
        $('#title_section_post').text($(this).val());
    });
   
});