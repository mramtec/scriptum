<?php
    
    $GET = filter_input(INPUT_GET, "message", FILTER_DEFAULT);
    
    if(isset($GET)){
        
        echo '<div class="message">';
            echo '<div class="message_inner">';
                echo '<h1><i class="fa fa-info-circle"></i></h1>';
                echo ClassMessages::Message($GET);
            echo '</div>';
        echo '</div>';

    }
?>