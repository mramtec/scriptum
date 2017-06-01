<<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />        
        <title>Instalação - Scriptum</title>
        <link href="../admin/assets/css/resets.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/css/install.css" rel="stylesheet" type="text/css" />
        <link href="../admin/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <script src="../admin/assets/js-plugins/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="../admin/assets/js-plugins/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../admin/assets/js-plugins/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <script src="../admin/assets/js/install.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <h1 style="z-index: 10;position: relative;"><i class="fa fa-cogs fa-fw"></i> Instalação do Scriptum</h1>
            <div class="color"></div>
        </header>
        <section class="container">
            <form method="post" action="ProcessInstall.php">
                
                <fieldset class="clearfix">
                    <legend><i class="fa fa-database"></i> Banco de dados e Configurações</legend>
                    
                    <div class="b_grid2">
                        <ul>
                            <li><input type="text" name="host_db" placeholder="Host" id="host" required="true"></li>
                            <li><input type="text" name="user_db" placeholder="Usuário" id="user" required="true"></li>
                            <li><input type="password" placeholder="Senha" id="pass1"></li>
                            <li><input type="password" name="pass_db" placeholder="Confirme Senha" id="pass2"></li>
                            <li><input type="text" name="database_db" placeholder="Banco de dados" id="database" required="true"></li>
                        </ul>
                    </div>
                    <div class="b_grid2">
                        <ul>
                            <li><input type="text" name="domain" placeholder="https://www.seudominio.com" id="domain" required="true"></li>
                            <li><input type="text" name="login_page" placeholder="Página de Login" id="login_page" required="true"></li>
                            <li><input type="text" name="admin_page" placeholder="Página administrador" id="admin_page" required="true"></li>
                            <li><input type="text" name="site_name" placeholder="Nome do Site" id="site_page" required="true"></li>
                            <li><input type="text" name="description" placeholder="Descrição"></li>
                        </ul>
                    </div>
                </fieldset>
                
                <fieldset class="first_user clearfix">
                    <legend><i class="fa fa-user-circle-o"></i> 1º Usuário</legend>

                    <ul>
                        <li><input type="text" name="nome" placeholder="Nome" id="nome" required="true"></li>
                        <li><input type="text" name="mail" placeholder="Email" id="email" required="true"></li>
                        <li><input type="password" placeholder="Senha" id="pass_user1" required="true"></li>
                        <li><input type="password" name="pass" placeholder="Senha" id="pass_user2" required="true"></li>
                    </ul>
                </fieldset>
                
                
                <fieldset class="clearfix">
                    <legend><i class="fa fa-file-image-o"></i> Dimensões de arquivos</legend>
                
                    <div class="b_grid3">
                        <h2>Miniatura</h2>
                        <ul>
                            <li>
                                <input type="text" name="thumbs_width" placeholder="Largura em pixels" value="960" id="thumbswidth">
                                <p>Largura</p>
                            </li>
                            <li>
                                <input type="text" name="thumbs_height" placeholder="Altura em pixels" value="960" id="thumbsheight">
                                <p>Altura</p>
                            </li>
                        </ul>
                    </div>
                    <div class="b_grid3">
                        <h2>Capa</h2>
                        <ul>
                            <li>
                                <input type="text" name="cover_width" placeholder="Largura em pixels" value="1280" id="coverwidth">
                                <p>Largura</p>
                            </li>
                            <li>
                                <input type="text" name="cover_height" placeholder="Altura em pixels" value="720" id="coverheight">
                                <p>Altura</p>
                            </li>
                        </ul>
                    </div>
                    <div class="b_grid3">
                        <h2>Perfil</h2>
                        <ul>
                            <li>
                                <input type="text" name="profile_width" placeholder="Largura em pixels" value="500" id="profilewidth">
                                <p>Largura</p>
                            </li>
                            <li>
                                <input type="text" name="profile_height" placeholder="Altura em pixels" value="500" id="profileheight">
                                <p>Altura</p>
                            </li>
                        </ul>
                    </div>
                </fieldset>
                
                <fieldset class="locale">
                    <legend><i class="fa fa-map"></i> Localização</legend>
                    
                    <ul>
                        <li>
                            <select class="timezone" name="timezone">
                                <option value="America/Adak">America Adak</option>              
                                <option value="America/Anchorage">America/Anchorage</option>    
                                <option value="America/Anguilla">America/Anguilla</option>
                                <option value="America/Araguaina">America/Araguaina</option>    
                                <option value="America/Adak">America Adak</option>              
                                <option value="America/Adak">America Adak</option>
                                <option value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
                                <option value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>  
                                <option value="America/Argentina/Cordoba">America/Argentina/Cordoba</option>
                                <option value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>              
                                <option value="America/Argentina/La_Rioja">America/Argentina/La_Rioja</option>  
                                <option value="America/Argentina/Mendoza">America/Argentina/Mendoza</option>
                                <option value="America/Argentina/Rio_Gallegos">America/Argentina/Rio_Gallegos</option>              
                                <option value="America/Argentina/Salta">America/Argentina/Salta</option>  
                                <option value="America/Argentina/San_Juan">America/Argentina/San_Juan</option>
                                <option value="America/Argentina/San_Luis">America/Argentina/San_Luis</option>              
                                <option value="America/Argentina/Tucuman">America/Argentina/Tucuman</option>  
                                <option value="America/Argentina/Ushuaia">America/Argentina/Ushuaia</option>
                                <option value="America/Aruba">America/Aruba</option>  
                                <option value="America/Asuncion">America/Asuncion</option>  
                                <option value="America/Atikokan">America/Atikokan</option>
                                <option value="America/Bahia">America/Bahia</option>  
                                <option value="America/Bahia_Banderas">America/Bahia_Banderas</option>  
                                <option value="America/Barbados">America/Barbados</option>
                                <option value="America/Belem">America/Belem</option>  
                                <option value="America/Belize">America/Belize</option>  
                                <option value="America/Blanc-Sablon">America/Blanc-Sablon</option>
                                <option value="America/Boa_Vista">America/Boa_Vista</option>  
                                <option value="America/Bogota">America/Bogota</option>  
                                <option value="America/Boise">America/Boise</option>
                                <option value="America/Cambridge_Bay">America/Cambridge_Bay</option>  
                                <option value="America/Campo_Grande">America/Campo_Grande</option> 
                                <option value="America/Cancun">America/Cancun</option>
                                <option value="America/Caracas">America/Caracas</option>  
                                <option value="America/Cayenne">America/Cayenne</option>  
                                <option value="America/Cayman">America/Cayman</option>
                                <option value="America/Chicago">America/Chicago</option>  
                                <option value="America/Chihuahua">America/Chihuahua</option>  
                                <option value="America/Costa_Rica">America/Costa_Rica</option>
                                <option value="America/Creston">America/Creston</option>  
                                <option value="America/Cuiaba">America/Cuiaba</option>  
                                <option value="America/Curacao">America/Curacao</option>
                                <option value="America/Danmarkshavn">America/Danmarkshavn</option>  
                                <option value="America/Dawson">America/Dawson</option>  
                                <option value="America/Dawson_Creek">America/Dawson_Creek</option>
                                <option value="America/Denver">America/Denver</option>  
                                <option value="America/Detroit">America/Detroit</option>  
                                <option value="America/Dominica">America/Dominica</option>
                                <option value="America/Edmonton">America/Edmonton</option>  
                                <option value="America/Eirunepe">America/Eirunepe</option>  
                                <option value="America/El_Salvador">America/El_Salvador</option>
                                <option value="America/Fort_Nelson">America/Fort_Nelson</option>  
                                <option value="America/Fortaleza">America/Fortaleza</option>  
                                <option value="America/Glace_Bay">America/Glace_Bay</option>
                            </select>
                        </li>
                        <li>
                            <input type="text" name="timezone_specified" placeholder="TimeZone">
                            <p><a href="http://php.net/manual/pt_BR/timezones.php" target="_blank">Timezone pelo PHP.net</a></p>
                        </li>
                    </ul>
                </fieldset>
                <div style="text-align: center;width: 100%;">
                    <button name="send">Instalar</button>
                </div>
            </form>
        </section>
    </body>
</html>