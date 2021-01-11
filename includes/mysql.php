<?php

    $server_DB="192.168.0.1";
    $username="user";
    $password="password";
    $database="database";
    
    mysql_connect($server_DB,$username,$password);

    @mysql_select_db($database) or die( "Impossibile selezionare il database.");
        
?>
