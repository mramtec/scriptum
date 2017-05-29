<?php require_once '../access/access_requires.php'; ?>


<div class="sidebar">
    <aside>
        <ul>
            <a href=".">
                <li>
                    <i class="fa fa-home fa-fw"></i> Início
                    <div class="asideload"></div>
                </li>
            </a>
            <a href="slide.php">
                <li>
                    <i class="fa fa-desktop fa-fw"></i> Slide-Show
                    <div class="asideload"></div>
                </li>                
            </a>
            <a href="create.php">
                <li>
                  <i class="fa fa-file-o fa-fw"></i> Criar
                  <div class="asideload"></div>
                </li>
            </a>
            <a href="read.php">
                <li>
                  <i class="fa fa-list-alt fa-fw"></i> Publicados
                  <div class="asideload"></div>
                </li>
            </a>
            <a href="profile.php">
                <li>
                  <i class="fa fa-user fa-fw"></i> Meu Perfil
                  <div class="asideload"></div>
                </li>
            </a>          
        <?php if($_SESSION['privilegio'] == 'administrador'){ ?>
            <a href="users.php" class="books">
                <li>
                  <i class="fa fa-users fa-fw"></i> Usuários
                  <div class="asideload"></div>
                </li>
            </a>
        <?php } ?>
            <a href="category.php">
                <li>
                  <i class="fa fa-th-list fa-fw"></i> Categorias
                  <div class="asideload"></div>
                </li>
            </a>
        <?php if($_SESSION['privilegio'] == 'administrador'){ ?>
            <a href="configs.php" class="configs">
                <li>
                  <i class="fa fa-cogs fa-fw"></i> Configurações
                  <div class="asideload"></div>
                </li>
            </a>
        <?php } ?>
            <a href="../access/access_logout.php">
                <li>
                    <i class="fa fa-power-off fa-fw"></i> Sair
                    <div class="asideload"></div>
                </li>
            </a>
        </ul>
    </aside>
</div>

<header class="clearfix">
    <img src="icon/icon_menu_light_gray.png" class="menu_btn"/>
    <div class="header_right">
        <?php
        if(isset($_SESSION['usuarioFoto'])){
            if(is_file('../'.$_SESSION['usuarioFoto']))
                echo '<a href="profile"><img src="../'.$_SESSION['usuarioFoto'].'" style="border-radius:50%50%;-moz-border-radius:50%50%;-webkit-border-radius:50%50%;" /></a>';
            else
                echo '<a href="profile"><img src="assets/img/default_user.png" style="border-radius:50%50%;-moz-border-radius:50%50%;-webkit-border-radius:50%50%;"/></a>';
        }else
            echo '<a href="profile"><img src="assets/img/default_user.png" style="border-radius:50%50%;-moz-border-radius:50%50%;-webkit-border-radius:50%50%;"/></a>';
        
        ?>
    </div>
    
    <div class="header_color"></div>
    <div class="header_color2"></div>
</header>

<div class="sidebar_color"></div>