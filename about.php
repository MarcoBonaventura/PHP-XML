<?php 
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    

    $dir = "./includes/";
    $ext = ".php";
    $p = "home"; 
    if(isset($_GET['page']))
    { 
        $p = $_GET['page'];
    }
    
    
    include($dir.$p.$ext);
            
?>
