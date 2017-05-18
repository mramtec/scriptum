<?php require_once 'class/ClassPost.php'; ?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="jornalismo, isabel tavares, reportagem, materia, comunicação, salvador, bahia, brasil, pesquisa">
        <meta name="description" content="Site da jornalista Isabel Tavares">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Isabel Tavares">
        <meta property="og:locale" content="pt_BR">
        <meta property="og:url" content="http://isabeltavares.com">
        <meta property="og:title" content="Isabel Tavares">
        <meta property="og:site_name" content="Isabel Tavares">
        <meta property="og:image:url" content="http://isabeltavares.com/img/capa_select.jpg">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="784">
        <meta property="og:image:height" content="300">
        <title>Isabel Tavares</title>
        <link rel="shortcut icon" href="img/favicon.png" />
        <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/resets.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/header.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/footer.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/menu_mobile.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/index.css" rel="stylesheet" type="text/css"/>
        <script src="assets/frameworks/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <script src="assets/js/header.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/js/menu_mobile.js"></script>
        <script type="text/javascript" src="assets/js/index.js"></script>
        <script>

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-86035210-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>
        <?php include 'assets/menu_mobile.php'; ?>
        <main>
            <?php include 'assets/header.php'; ?>

            <section>
                <div class="box1 clearfix">

                </div>
                
                <div class="box1_btn clearfix">
                    <button>Carregar</button>
                </div>

                <div class="box2">

                    <div class="box2_space clearfix">
                        <div class="box2_grid">
                            <div class="box2_grid_inner">
                                <div class="box2_grid_inner_color"></div>
                                <div class="box2_grid_inner_bg" style="background: url(assets/amostras/livros/03.jpg) scroll center center no-repeat;background-size:cover;"></div>
                                <img src="assets/amostras/livros/03.jpg" />
                                <h1>Os Frutos</h1>
                                <p>
                                    Ano de edição: 2016
                                </p>
                                <p>
                                    Idioma: Português
                                </p>
                                <p>
                                    Nº de páginas: 28
                                </p>
                                <br>
                                <a href="http://isabeltavares.com/uploads/doc/dcc27c0a92d1cb10b90f2c556a1529c6.pdf" target="_blank"><button>Download</button></a>
                            </div>
                        </div>
                        <div class="box2_grid">
                            <div class="box2_grid_inner">
                                <div class="box2_grid_inner_color"></div>
                                <div class="box2_grid_inner_bg" style="background: url(assets/amostras/livros/02.jpg) scroll center center no-repeat;background-size:cover;"></div>
                                <img src="assets/amostras/livros/02.jpg" />
                                <h1>Ao Vencedor</h1>
                                <p>
                                    Ano de edição: 2016
                                </p>
                                <p>
                                    Idioma: Português
                                </p>
                                <p>
                                    Nº de páginas: 36
                                </p>
                                <br>
                                <a href="http://isabeltavares.com/uploads/doc/59b1e4de6f6025318c5757688c0cf8c2.pdf" target="_blank"><button>Download</button></a>
                            </div>
                        </div>
                        <div class="box2_grid">
                            <div class="box2_grid_inner">
                                <div class="box2_grid_inner_color"></div>
                                <div class="box2_grid_inner_bg" style="background: url(assets/amostras/livros/01.jpg) scroll center center no-repeat;background-size:cover;"></div>
                                <img src="assets/amostras/livros/01.jpg" />
                                <h1>Entre a Fé e a Paixão</h1>
                                <p>
                                    Ano de edição: 2016
                                </p>
                                <p>
                                    Idioma: Português
                                </p>
                                <p>
                                    Nº de páginas: 132
                                </p>
                                <br>                            
                                <a href="http://isabeltavares.com/uploads/doc/775f2e9cb31085dc0b539305fc3b8ad2.pdf" target="_blank"><button>Download</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="box2_color"></div>
                </div>

                <div class="box3 clearfix">

                    <h1>+Acessadas</h1>

                    <div class="box3_space">
                        <?php
                            $post = new ClassPost();
                            $maisAcessadas = $post->post_todos(0, 1, 6, TRUE);
                            if($maisAcessadas != false){
                                foreach($maisAcessadas as $data){
                                    echo '<div class="box3_grid">';
                                        echo '<a href="post?u='.$data->post_url.'">';
                                            echo '<div class="box3_grid_inner">';
                                                echo '<div class="box3_grid_inner_logo"><img src="img/logo.png" title="Isabel Tavares" /></div>';
                                                if(strlen($data->post_categoria) != 0)
                                                    echo '<div class="box3_grid_inner_tag">'.ClassCategory::categoria_identificar_titulo($data->post_categoria).' <i class="fa fa-tags"></i></div>';

                                                echo '<div class="box3_grid_inner_text">';
                                                    echo $data->post_titulo;
                                                echo '</div>';
                                                echo '<div class="box3_grid_inner_border"></div>';
                                                echo '<div class="box3_grid_inner_color"></div>';
                                                echo '<div class="box3_grid_inner_color2"></div>';
                                                echo '<div class="box3_grid_inner_image" style="background: url('.$data->post_miniatura.') scroll center center no-repeat;background-size: cover;"></div>';
                                            echo '</div>';
                                        echo '</a>';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>

            <?php include 'assets/footer.php'; ?>
        </main>
    </body>
</html>
