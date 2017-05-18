<?php
    require_once 'class/ClassUsers.php';
    
    $user = new ClassUsers();
    $user->id = 1;
 
    foreach($user->users_exibir_selecionado() as $user_load);

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
        <meta property="og:url" content="http://isabeltavares.com">
        <meta property="og:title" content="Isabel Tavares">
        <meta property="og:site_name" content="Isabel Tavares">
        <meta property="og:image:url" content="http://isabeltavares.com/img/capa_select.jpg">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="784">
        <meta property="og:image:height" content="300">
        <title>Sobre Isabel Tavares</title>
        <link rel="shortcut icon" href="img/favicon.png" />
        <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/resets.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/header.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/footer.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/menu_mobile.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/sobre.css" rel="stylesheet" type="text/css"/>
        <script src="assets/frameworks/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/frameworks/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <script src="assets/js/header.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/js/menu_mobile.js"></script>
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

            <section class="content">
                
                <?php if(is_file($user_load->usuario_capa)){ ?>
                    <div class="box1">
                        <img src="<?php echo $user_load->usuario_capa; ?>" />
                    </div>
                <?php } ?>
                
                <div class="box2">
                    <?php
                        echo '<h1 class="box2_title">'.$user_load->usuario_nome.'</h1>';
                    ?>
                    
                    <div class="box2_text">
                        <?php
                            echo $user_load->usuario_sobre;
                        ?>
                    </div>
                </div>
                
            </section>

            <?php include 'assets/footer.php'; ?>
        </main>
    </body>
</html>