<?php

    require_once 'class/ClassPost.php';
    require_once 'class/ClassCategory.php';
    
    $url = filter_input(INPUT_GET, "u", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $post = new ClassPost();
    $post->url = $url;
    $foreach = $post->post_selecionado('url');
    
    foreach($foreach as $data);
    
        $user_cookie = $data->post_url;
	$val_cookie = $post->id = $data->id;
	$duracao = (time() + (7 * 24 * 3600));

	if(!isset($_COOKIE[ $user_cookie ])){
		
                $post->visualizacoes = $data->post_visualizacoes + 1;
                $post->post_visualizacoes();
		setcookie($user_cookie, $val_cookie, $duracao);
	}

?>

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
        <meta property="og:url" content="http://isabeltavares.com?u=<?php echo $data->post_url; ?>">
        <meta property="og:title" content="<?php echo $data->post_titulo; ?> - Isabel Tavares">
        <meta property="og:site_name" content="Isabel Tavares">
        <meta property="og:image:url" content="http://isabeltavares.com/<?php echo $data->post_miniatura; ?>">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="790">
        <meta property="og:image:height" content="310">
        <title><?php echo $data->post_titulo; ?> - Isabel Tavares</title>
        <link rel="shortcut icon" href="img/favicon.png" />
        <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/resets.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/header.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/footer.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/menu_mobile.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/post.css" rel="stylesheet" type="text/css"/>
        <script src="assets/frameworks/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <script src="assets/js/header.js" type="text/javascript"></script>
        <script src="assets/js/menu_mobile.js" type="text/javascript"></script>
        <script src="assets/frameworks/scrollreveal.min.js" type="text/javascript"></script>
        <script src="assets/js/post.js" type="text/javascript"></script>
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
            <a class="elementempty" href="#startcontent"></a>
            <?php include 'assets/header.php'; ?>

            <section class="container" id="startcontent">
                
                <div class="post_header" style="background: url(<?php if(is_file($data->post_miniatura)){ echo $data->post_miniatura; }else{ echo "img/bg_header.jpg"; } ?>) scroll center center no-repeat;background-size: cover;">
                    <div class="post_header_inner">
                        <h1><?php echo $data->post_titulo; ?></h1>
                        <span><i class="fa fa-eye"></i> <?php echo $data->post_visualizacoes; ?> visualizações | <i class="fa fa-tags"></i> <?php
                        
                        if(strlen($data->post_categoria) != 0){ 
                            echo ClassCategory::categoria_identificar_titulo($data->post_categoria);
                        }else{ 
                            echo "Sem Categoria";
                        } 
                        
                        ?></span>

                        <div class="post_header_social">
                            <ul>
                                <li><a href="http://www.facebook.com/share.php?u=www.isabeltavares.com/post?u=<?php echo $data->post_url?>"><i class="fa fa-facebook-official"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url=www.isabeltavares.com/post?u=<?php echo $data->post_url?>&text=<?php echo $data->post_titulo?>"><i class="fa fa-twitter-square"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=http://www.isabeltavares.com/post?u=<?php echo $data->post_url; ?>"><i class="fa fa-google-plus-square"></i></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.isabeltavares.com?u=<?php echo $data->post_url; ?>&title=<?php echo $data->post_titulo; ?>"><i class="fa fa-linkedin-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post_header_color"></div>
                </div>
                
                <div class="post_header_info clearfix">
                    <div class="post_header_info_left">Publicado em <?php echo date("d.m.Y", strtotime($data->post_data)); ?></div>
                    <div class="fb-like post_header_info_left" data-href="http://isabeltavares.com/post?u=<?php echo $data->post_url; ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
                </div>
                
                <h2 class="post_subtitle"><?php echo $data->post_subtitulo; ?></h2>
                
                <div class="content clearfix">
                    <div class="post_text">
                        
                        <?php echo $data->post_texto; ?>
                        
                        <div class="post_text_comments">
                            <div class="box_fb" style="text-align: center;">
                                <div class="fb-comments" data-href="http://isabeltavares.com/post?u=<?php echo $data->post_url; ?>" data-numposts="5"></div>
                            </div>
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                    <div class="post_related">
                        
                        <?php

                            $maisAcessadas = $post->post_todos(0, 1, 5, FALSE, TRUE);
                            if($maisAcessadas != false){
                                foreach($maisAcessadas as $data2){
                                    echo '<div class="post_grid">';
                                        echo '<a href="post?u='.$data2->post_url.'">';
                                            echo '<div class="post_grid_inner">';
                                                echo '<div class="post_grid_inner_image" style="background: url('.$data2->post_miniatura.') scroll center center no-repeat;background-size: cover;"></div>';
                                                echo '<h1>'.$data2->post_titulo.'</h1>';
                                                echo '<h2>'.$data2->post_subtitulo.'</h2>';
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
        <script>
            window.sr = ScrollReveal({ reset: true });
            sr.reveal('.post_header, .post_text img', { duration: 500 });
            sr.reveal('.post_subtitle', { duration: 900 });
            sr.reveal('.post_grid', {duration: 450, origin: 'right', distance: '30px'});
            
            
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://isabeltavares.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
        </script>
    </body>
</html>