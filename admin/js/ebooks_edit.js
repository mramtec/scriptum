$(document).ready(function(){

    tinymce.init({
        selector: '#textarea',
        language: 'pt_BR',
        skin: 'isabeltavares',
        height: 340,
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
                $('#titulo').css('border', '2px red solid');
                return false;
            }

            if($("#tags").val() == ''){
                $('#tags').css('border', '2px red solid');
                return false;
            }

            if($('#textarea').val() == ''){
                $('#textarea').css('border', '2px red solid');
                return false;
            }
        });
    });

/******************************* Miniatura ********************************************************/
    $('#delete_miniatura').on('click', function(){                                              /**/
        $('.box_miniatura_exists').fadeOut('slow', function(){                                  /**/
            $('.box_miniatura').fadeIn();                                                       /**/
        });                                                                                     /**/
    });                                                                                         /**/
                                                                                                /**/
    $(".box_miniatura, .box_miniatura_exists img").on("click", function(){                      /**/
        $("#miniatura").trigger("click");                                                       /**/
    });                                                                                         /**/
                                                                                                /**/
    $("#miniatura").on("change", function(){                                                    /**/
        if($(this).val().indexOf(".jpg") != -1)                                                 /**/
            $('.box_miniatura .fa').removeClass("fa-cloud-upload").addClass("fa-check");        /**/
        else                                                                                    /**/
            $('.box_capa .fa').removeClass("fa-cloud-upload").addClass("fa-times");             /**/
    });                                                                                         /**/
                                                                                                /**/
/******************************* Miniatura ********************************************************/

/******************************* Capa *************************************************************/
    $('#delete_capa').on('click', function(){                                                   /**/
        $('.box_capa_exists').fadeOut('slow', function(){                                       /**/
            $('.box_capa').fadeIn();                                                            /**/
        });                                                                                     /**/
    });                                                                                         /**/
                                                                                                /**/
    $(".box_capa, .box_capa_exists img").on("click", function(){                                /**/
        $("#capa").trigger("click");                                                            /**/
    });                                                                                         /**/
                                                                                                /**/
    $("#capa").on("change", function(){                                                         /**/
        if($(this).val().indexOf(".jpg") != -1)                                                 /**/
            $('.box_capa .fa').removeClass("fa-cloud-upload").addClass("fa-check");             /**/
        else                                                                                    /**/
            $('.box_capa .fa').removeClass("fa-cloud-upload").addClass("fa-times");             /**/
    });                                                                                         /**/
/******************************* Capa *************************************************************/

/******************************* DOC **************************************************************/
    $('#delete_doc').on('click', function(){                                                    /**/
        $('.box_doc_exists').fadeOut('slow', function(){                                        /**/
            $('.box_pdf').fadeIn();                                                             /**/
        });                                                                                     /**/
    });                                                                                         /**/
                                                                                                /**/
    $(".box_pdf, .box_doc_exists").on("click", function(){                                      /**/
        $("#documento").trigger("click");                                                       /**/
    });                                                                                         /**/
                                                                                                /**/
    $("#documento").on("change", function(){                                                    /**/
        if($(this).val().indexOf(".pdf") != -1)                                                 /**/
            $('.box_pdf .fa').removeClass("fa-cloud-upload").addClass("fa-check");              /**/
        else                                                                                    /**/
            $('.box_pdf .fa').removeClass("fa-cloud-upload").addClass("fa-times");              /**/
    });                                                                                         /**/
/******************************* DOC **************************************************************/
});