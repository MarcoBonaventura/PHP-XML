<div id="menu">

<?php
    if (isset($_GET['page']))
    {
        $page = $_GET['page'];
        if (isset($_GET['book']))
        {
            $menu = $_GET['book'];
            if ($menu == "LibroFiliali")
            {
            

?>
    
    <div id="nav"> <!-- div #nav -->
        <ul id="tabBar">
            <li><a href="index.php?page=books&book=LibroItalia" onclick="InitSpinner()">LIBRO ITALIA</a></li>
            <li><a href="index.php?page=books&book=LibroFiliali" class="selected" onclick="InitSpinner()">LIBRO FILIALI</a></li>
            <li><a href="index.php?page=books&book=LibroPiano" onclick="InitSpinner()">LIBRO PIANO</a></li>
        </ul>

    <div id="subNav"> <!-- div #subNav -->
        <ul>
            <li><a href="#Giornalieri">Giornalieri</a></li>
            <li><a href="#Lunedi">Lunedi</a></li>
            <li><a href="#Martedi">Martedi</a></li>
            <li><a href="#Mercoledi">Mercoledi</a></li>
            <li><a href="#Giovedi">Giovedi</a></li>
            <li><a href="#Venerdi">Venerdi</a></li>
            <li><a href="#Sabato">Sabato</a></li>
            <li><a href="#Job_del_15">Job 15</a></li>
            <li><a href="#Job_del_10_e_20">Job 10 e 20</a></li>
            <li><a href="#FineMese">Fine Mese</a></li>
            <li><a href="#UltimoGiorno">Ultimo Giorno</a></li>
        </ul>
    </div> <!-- end #subNav -->       
        
<?php
            }
            elseif ($menu == "LibroPiano")
            {
?>
        
    <div id="nav"> <!-- div #nav -->
        <ul id="tabBar">
            <li><a href="index.php?page=books&book=LibroItalia" onclick="InitSpinner()">LIBRO ITALIA</a></li>
            <li><a href="index.php?page=books&book=LibroFiliali" onclick="InitSpinner()">LIBRO FILIALI</a></li>
            <li><a href="index.php?page=books&book=LibroPiano" class="selected" onclick="InitSpinner()">LIBRO PIANO</a></li>
        </ul>
    
    <div id="subNav"> <!-- div #subNav -->
        <ul>
            <li><a href="#Lunedi">Lunedi</a></li>
            <li><a href="#Martedi">Martedi</a></li>
            <li><a href="#Mercoledi">Mercoledi</a></li>
            <li><a href="#Giovedi">Giovedi</a></li>
            <li><a href="#Venerdi">Venerdi</a></li>
        </ul>
    </div> <!-- end #subNav -->
    
<?php
            }
            elseif ($menu == "LibroItalia")
            {
?>
    
    <div id="nav"> <!-- div #nav -->
        <ul id="tabBar">
            <li><a href="index.php?page=books&book=LibroItalia"  class="selected" onclick="InitSpinner()">LIBRO ITALIA</a></li>
            <li><a href="index.php?page=books&book=LibroFiliali" onclick="InitSpinner()">LIBRO FILIALI</a></li>
            <li><a href="index.php?page=books&book=LibroPiano" onclick="InitSpinner()">LIBRO PIANO</a></li>
        </ul>
            
    <div id="subNav"> <!-- div #subNav -->
        <ul>
            <li><a href="#Giornalieri" class="subNavBtn">Giornalieri</a></li>
            <li><a href="#Lunedi" class="subNavBtn">Lunedì</a></li>
            <li><a href="#Martedi" class="subNavBtn">Martedì</a></li>
            <li><a href="#Mercoledi">Mercoledi</a></li>
            <li><a href="#Giovedi">Giovedi</a></li>
            <li><a href="#Venerdi">Venerdi</a></li>
            <li><a href="#Sabato">Sabato</a></li>
            <li><a href="#DRP">DRP</a></li>
        </ul>
    </div> <!-- end #subNav -->
    
<?php
            }    
        }
        else
        {
?> 
    
    <div id="nav"> <!-- div #nav -->
        <ul id="tabBar">
            <li><a href="index.php?page=books&book=LibroItalia" class="selected" onclick="InitSpinner()">LIBRO ITALIA</a></li>
            <li><a href="index.php?page=books&book=LibroFiliali" onclick="InitSpinner()">LIBRO FILIALI</a></li>
            <li><a href="index.php?page=books&book=LibroPiano" onclick="InitSpinner()">LIBRO PIANO</a></li>
        </ul>
       
    <div id="subNav"> <!-- div #subNav -->
        <ul>
            <li><a href="#Giornalieri">Giornalieri</a></li>
            <li><a href="#Lunedi">Lunedì</a></li>
            <li><a href="#Martedi">Martedì</a></li>
            <li><a href="#Mercoledi">Mercoledi</a></li>
            <li><a href="#Giovedi">Giovedi</a></li>
            <li><a href="#Venerdi">Venerdi</a></li>
            <li><a href="#Sabato">Sabato</a></li>
        </ul>
    </div> <!-- end #subNav -->
    
<?php  
        }
    }
?> 

   
    
    </div> <!-- end #nav -->

</div> <!-- end #menu -->