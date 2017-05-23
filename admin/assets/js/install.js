$(document).ready(function(){
    
    function borderBottomCoral( ElementThis ){
        ElementThis.css('border-bottom', '2px lightcoral solid');
    }
    
    function borderBottomGreen( ElementThis ){
        ElementThis.css('border-bottom', '2px limegreen solid');
    }

    
    $('#pass2').keyup(function(){

        if( $(this).val() !== $('#pass1').val() ){
            borderBottomCoral($(this));
        }else{
            borderBottomGreen($(this));
        }

    });
    
    
    $('#domain').keyup(function(){
        if($(this).val().length != 0){
            $('#login_page').val($(this).val() + '/login');
            $('#admin_page').val($(this).val() + '/admin/');
        }else{
            $('#login_page').val('');
            $('#admin_page').val('');
        }
    });
    
    
    $('#pass_user2').keyup(function(){
        if( $(this).val() !== $('#pass_user1').val() ){
            borderBottomCoral($(this));
        }else{
            borderBottomGreen($(this));
        }
    });
    
    
    $('form').submit(function(){
        var DB_Host = $('#host').val();
        var DB_User = $('#user').val();
        var DB_Pass = $('#pass2').val();
        var DB_Data = $('#database').val();
        var Dominio = $('#domain').val();
        var PageLogin = $('#login_page').val();
        var PageAdmin = $('#admin_page').val();
        var SiteNome = $('#site_page').val();
        var MailUser = $('#email').val();
        var PassUser = $('#pass_user2').val();
        var ThumbsWidth = $('#thumbswidth').val();
        var ThumbsHeight = $('#thumbsheight').val();
        var CoverWidth = $('#coverwidth').val();
        var CoverHeight = $('#coverheight').val();
        var ProfileWidth = $('#profilewidth').val();
        var ProfileHeight = $('#profileheight').val();
        
        if(DB_Host.length === 0){
            borderBottomCoral($(this));
            return false;
        }
        if(DB_User.length === 0){
            borderBottomGreen($(this));
            return false;
        }

    });
        
    
    
});