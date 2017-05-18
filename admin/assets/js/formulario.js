$(document).ready(function(){

    tinymce.init({
        selector: '#textarea',
        language: 'pt_BR',
        height: 360,
        skin: 'isabeltavares',
        plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste jbimages",
            ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        relative_urls: false,
        document_base_url: '../'
    });

    $(".button").click(function(){
	$('.post').submit(function(){
            if($("#titulo").val() == ''){    
                $('#titulo').css('border', '2px red solid').focus();
                return false;
            }
	});
    });

});