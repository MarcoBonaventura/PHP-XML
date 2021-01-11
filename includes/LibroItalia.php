<article>
 
<?php

    session_start();
    $_SESSION['$tempXML'];

    $reader = new XMLReader();
    $reader->open('.\dataXML\data.xml');
    $doc = new DOMDocument();
    
    
    $XMLdata = "";
    $tempXML = "";
    if (file_exists('./dataXML/data.xml')) 
    {
        $XMLdata = simplexml_load_file('./dataXML/data.xml');
        $tempXML = $XMLdata;
        //print_r($XMLdata);    // only for debug
    } 
    else 
    {
        exit('Failed to open test.xml.');   
    }

    
    
    $i = 0;
    foreach($XMLdata->day_title as $myJob)
    {
        echo "<br>";
        echo "<ul><li id=\"day\"><p><hr>";
        echo $myJob['name']."<br><br></li></ul>";
        $index = 0;
    
       
        echo "<li id=\"spazio\"></li>";
        
        include('./includes/insertJob.php');
       
        
        foreach($myJob as $job)
        {
            
?>   
        
    <ul>
        <li id="id">
            <?php echo $myJob->job[$index]['id'];                   ?>
        </li>
        <li id="lib">
            <?php echo $myJob->job[$index]->lib;                    ?>
        </li>
        <li id="macro">
            <?php echo $myJob->job[$index]->macro;                  ?>
        </li>
        <li id="susp">
            <?php echo $myJob->job[$index]->suspended;              ?>
        </li>
        <li id="nome">
            <?php echo $myJob->job[$index]->nome;                   ?>
        </li>
        <li id="desc">
            <?php echo $myJob->job[$index]->desc;                   ?>
        </li>
        <li id="edit">
            <?php include('./includes/editJob.php');                ?>
        </li>
    </ul>
        
<?php
    
        include('./includes/insertJob.php');
        
        $index++;
        }
        echo "<li id=\"spazio\"></li>";
        echo "</ul><br><br>";
    }

?>

</article>


