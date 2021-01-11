<?php //session_start() ?>

<dl>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    //start session
    
    //session_regenerate_id(TRUE);

    include ('./includes/mysql.php');
    
    $logged = False;
    
    
    
    if(isset($_GET['page']))
    {
       $THISpage =  $_GET['book'];
       if($THISpage == "LibroItalia")
       {
           $action = "index.php?page=books&book=LibroItalia";
       }
       if ($THISpage == "LibroFiliali")
       {
           $action = "index.php?page=books&book=LibroFiliali";
       }
       if($THISpage == "LibroPiano")
       {
           $action = $action = "index.php?page=books&book=LibroPiano";
       }
    }
    
    if(isset($_POST['required']))
    {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        //$_SESSION['logged'] = true;
        
        if ($user == 'oper' && $pass == 'oper')
        {
            $logged = true;
            $_SESSION['logged'] = true;
        }
        
    }
    

    
    $allow = False;
    
    $tempIP = $_SERVER['REMOTE_ADDR'];
    $hostname = gethostbyaddr($tempIP);
    //echo $hostname;
    if ($hostname == 'hostname' or $hostname == 'hostname' or $hostname == 'hostname')
    {
        $allow = True;        
    }

    if ($logged == true or isset($_SESSION['logged']))
        {
    ?>
            <dd>login effettuato</dd>
            <dd><a href="<?php echo $action."&logout=yes" ?>">logout</a></dd>
            <dd><a href="index.php?page=XML_Tools">XML Tools</a></dd>
            <dd></dd>
    <?php 
        }
        else 
        {
    ?>  
        
            <dd>
            <form id="access" method="POST" action="<?php echo $action ?>">
                <input type="text" name="user" id="user" placeholder="username" required>
                <input type="password" name="pass" id="pass" placeholder="xxxxxxxx" required>
                <button type="submit" name="Submit" id="Submit" value="login">Login</button>
                <input type="hidden" name="required" value="user,pass">
            </form>
            </dd>
    <?php
        }
        if ($allow)
        {
   
        }
    ?>
        <dt>Creato da</dt>
        <dd><address><a href="mailto:pinco.pallino@dominio.com">Marco Bonaventura</a></address></dd>
        <dt>Ultimo aggiornamento</dt>
        <dd><time datetime="2016-01-19" pubdate>martedì 19 gennaio 2016</time></dd>
    </dl>
