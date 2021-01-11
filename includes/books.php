<?php 
ini_set("session.gc_maxlifetime", "300"); ?>


<article>
<style type="text/css">
    .tg  {width:100%; border-collapse:collapse;border-spacing:0;border:none;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z1{text-align:center; width:10%}
    .tg .tg-031e{text-align:center; width:35%;}
    .tg .tg-s6z2{text-align:center; width:35%; height:100%;}
    .tg .tg-s6zs{text-align:center; width:6%}
    .tg .tg-s6z0{text-align:center; width:4%}
    @media screen and (max-width: 100%) {.tg {width: 100% !important;}.tg col {width: 100% !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
</style>   
<link rel="stylesheet" href="alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="alertify/themes/alertify.default.css" id="toggleCSS" />
<style>
    .alertify-log-custom {
            background: blue;
    }
</style>
<script>
function deljob() {
    var deleteJob;
    var r = confirm("sicuro di voler cancellare questo job");
    if (r === true) {
        //deleteJob = "You pressed OK!";
    } else {
        //deleteJob = "You pressed Cancel!";
    }
}
</script>



<?php

    if(isset($_GET['logout']))
    {
        if($_GET['logout'] == "yes")
        {
            session_destroy();
        }
    }
    
    //session_start();
    //session_regenerate_id(TRUE);
    
    if(isset($_SESSION['logged']) == true)
    {
        //$loggedIn = $_SESSION['logged'];
        $loggedIn = true;
        //echo "<br>sei loggato";
    }
    else
    {
        $loggedIn = false;
        //echo "<br>LOGIN FALLITO!";
    }
    
    //print_r($_SESSION);
    
    $allow = False;
    $tempIP = $_SERVER['REMOTE_ADDR'];
    $hostname = gethostbyaddr($tempIP);
    //echo $hostname;
    if ($hostname == 'hostname' or $hostname == 'hostname' or $hostname == 'hostname' or $loggedIn == true)
    {
        $allow = True;        
    }
    
    
    $file = "";
       
    
    if(isset($_GET['book']))
    {
        $theBook = $_GET['book'];
        $XMLdata = "";
        $tempXML = "";
        $newJob = array();
        $hashVector = array();
        $insertID = 0;
        $loadFile = True;
        //$next = True;
        switch ($theBook)
        {
            case "LibroItalia":
                $file = ".\includes\books\LibroItalia.xml";
                break;
            case "LibroFiliali":
                $file = ".\includes\books\LibroFiliali.xml";
                break;
            case "LibroPiano":
                $file = ".\includes\books\LibroPiano.xml";
                break;
        }
    }
    else 
    {
        $loadFile = false;
    }
    
    /* Insert new job */
    if(isset($_POST['inserisci_dopo'])) 
    {
        $NomeJob = $_POST['NomeJob'];
        $Libreria = $_POST['Libreria'];
        $Macro = $_POST['Macro'];
        $parametri = $_POST['parametri'];
        $nota = $_POST['nota'];
        $sospeso = $_POST['sospeso'];
        $ID = $_POST['inserisci_dopo'];
        $next = $_POST['next'];
            
        //echo "<br><br><br>insertJob ".$ID."<br>";
        
        $newJob[0] = $_POST['inserisci_dopo'];
        $newJob[1] = $_POST['NomeJob'];
        $newJob[2] = $_POST['Libreria'];
        $newJob[3] = $_POST['Macro'];
        $newJob[4] = $_POST['parametri'];
        $newJob[5] = $_POST['nota'];
        $newJob[6] = $_POST['sospeso'];
        $newJob[7] = $_POST['ven2x'];
        
        //echo "nome job: ".$newJob[1]."<br>";
        $loadFile = False;
        $XMLdata = insertJob($newJob, $file, $next);
        
        //$XMLdata = simplexml_insert_after($newJob, $file);
        
    }
    
    if(isset($_POST['Edit']))
    {
        $newJob[0] = $_POST['Edit'];
        $newJob[1] = $_POST['NomeJob'];
        $newJob[2] = $_POST['Libreria'];
        $newJob[3] = $_POST['Macro'];
        $newJob[4] = $_POST['Parametri'];
        $newJob[5] = $_POST['Nota'];
        $newJob[6] = $_POST['Sospeso'];
        $newJob[7] = $_POST['ven2x'];
        
        //echo $file;
        $XMLdata = editJob($newJob, $file);
    }

    
    if(isset($_POST['Del']))
    {
        $key = $_POST['Del'];
        //echo "<br><br>XXXXX<br>";
        //echo $key;
        deleteJob($key, $file);
    }
    
    $reader = new XMLReader();
    $reader->open($file);
    $doc = new DOMDocument();
    
    if($loadFile)
    {
        if (file_exists($file))
        {
            $XMLdata = simplexml_load_file($file);
            //print_r($XMLdata);    // only for debug
        } 
        else 
        {
            exit('Failed to open'.$file);   
        }
    }
       
    
    
    
    /*** edit an existing job into the XML file ***/
    function editJob($newJob, $file) {
        
        //var_dump($newJob);
        
        $tempXML = simplexml_load_file($file);
        
        //var_dump($tempXML);
        
        for ($i=0; $i < count($tempXML); $i++)
        {
            $Day = $tempXML->day_title[$i];
            for ($y=0; $y < count($tempXML->day_title[$i]->job); $y++)
            {
                if ($newJob[0] == $tempXML->day_title[$i]->job[$y]['id'])
                {
                    //echo "job trovato!";
                    $newJob[0] = md5($Day.$newJob[2].$newJob[3].$newJob[1]);
                    $tempXML->day_title[$i]->job[$y]['id']      = $newJob[0];
                    $tempXML->day_title[$i]->job[$y]->nome      = $newJob[1];
                    $tempXML->day_title[$i]->job[$y]->lib       = $newJob[2];
                    $tempXML->day_title[$i]->job[$y]->macro     = $newJob[3];
                    $tempXML->day_title[$i]->job[$y]->param     = $newJob[4];
                    $tempXML->day_title[$i]->job[$y]->desc      = $newJob[5];
                    $tempXML->day_title[$i]->job[$y]->suspended = $newJob[6];
                    $tempXML->day_title[$i]->job[$y]->ven2x     = $newJob[7];
                }
            }
        }
        
        
        //print_r(simplexml_import_dom($tempXML->day_title[$i]->job[$y]['id']));
        
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($tempXML->asXML());
        $dom->saveXML();
        $dom->save($file);
        
        return $tempXML;
        
         
    }
    
    
    /*** edit an existing job into the XML file ***/
    function deleteJob($key, $file) {
        
        
        //var_dump($newJob);
        
        $tempXML = simplexml_load_file($file);
        
        //var_dump($tempXML);
        
        for ($i=0; $i < count($tempXML); $i++)
        {
            for ($y=0; $y < count($tempXML->day_title[$i]->job); $y++)
            {
                if ($key == $tempXML->day_title[$i]->job[$y]['id'])
                {
                    unset($tempXML->day_title[$i]->job[$y]);
                }
            }
        }
        
        
        //print_r(simplexml_import_dom($tempXML->day_title[$i]->job[$y]['id']));
        
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($tempXML->asXML());
        $dom->saveXML();
        $dom->save($file);
        
        return $tempXML;
        
         
    }
         
    
    
    /*** insert new job into XML file ***/
    function insertJob($newJob, $file, $next) {
        
        $tempXML = simplexml_load_file($file);
        
        //print_r($tempXML);
        
        for ($i=0; $i < count($tempXML); $i++)
        {
            $Day = $tempXML->day_title[$i];
            for ($y=0; $y < count($tempXML->day_title[$i]->job); $y++)
            {
                if ($newJob[0] == $tempXML->day_title[$i]->job[$y]['id'])
                {
                    $Child = new SimpleXMLElement($tempXML->asXML());
                    
                    $ind = count($tempXML->day_title[$i-1]->job);
                    $ii = $i -1;
                    $ind2 = $ind -1;
                        
                    if ($y == 0)
                    {
                        if ($i == 0)
                        {
                            if ($next == "True")
                            {
                                $target_dom = dom_import_simplexml($tempXML->day_title[0]->job[$i]);
                                $target_dom = $target_dom->nextSibling;
                            }
                            else
                            {
                                $target_dom = dom_import_simplexml($tempXML->day_title[0]->job[$i]);
                            }
                        }
                        else 
                        {
                            if ($next == "True")
                            {
                                $target_dom = dom_import_simplexml($tempXML->day_title[$i]->job[$y]);
                                $target_dom = $target_dom->nextSibling;
                            }
                            else
                            {
                                $target_dom = dom_import_simplexml($tempXML->day_title[$i]->job[$y]);
                            }
                        }      
                    }
                    else if($y == 1)
                    {
                        if ($i > 0)
                        {
                            $target_dom = dom_import_simplexml($tempXML->day_title[$i]->job[$y]);
                            $target_dom = $target_dom->nextSibling;
                        }
                        else
                        {
                            $target_dom = dom_import_simplexml($tempXML->day_title[$i]->job[$y]);
                        }
                    }
                    else if ($y > 1)
                    {
                        $target_dom = dom_import_simplexml($tempXML->day_title[$i]->job[$y]);
                        $target_dom = $target_dom->nextSibling;
                    }
                    else if ($y < 0)
                    {
                        echo "ERROR!";
                    }
                    
                    $newChild = $Child->day_title[$i]->addChild("job");
                    
                    $newJob[0] = md5($Day.$newJob[2].$newJob[3].$newJob[1]);
                    $newChild->addAttribute("id", $newJob[0]); 
                    $newChild->addChild("lib", $newJob[2]); 
                    $newChild->addChild("macro", strtoupper($newJob[3]));
                    $newChild->addChild("suspended", $newJob[6]);
                    $newChild->addChild("ven2x", $newJob[7]);
                    $newChild->addChild("nome", strtoupper($newJob[1]));
                    $newChild->addChild("param", $newJob[4]);
                    $newChild->addChild("desc", $newJob[5]);
                                    
                    $ins_dom = $target_dom->ownerDocument->importNode(dom_import_simplexml($newChild), true);
                                       
                }
            }
        }
        
        if($target_dom->nextSibling)
        {
            $target_dom->parentNode->insertBefore($ins_dom, $target_dom);
        }
        else
        {
            $target_dom->parentNode->appendChild($ins_dom);
        }
        
        
        
        //$filename = ".\dataXML\LibroItaliaTEST.xml";
        $filename = $file;
        //echo $tempXML->asXML();
        
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($tempXML->asXML());
        $dom->saveXML();
        $dom->save($filename);
        
        //print_r($tempXML);
        return $tempXML;
        
    }
   
       
    function get_bool($value) {
    
        switch( strtolower($value) ) {
            
            case "true":    return true;
            case "false":   return false;
                
            default: return NULL;
        }
    }

    
    //***** XML PARSER *****
    
    
    
    $h = 0;
    for ($index=0; $index < count($XMLdata); $index++)
    {
        echo "<div id= \"spessore\"></div>";
        echo "<ul><li id=\"day\"><hr>";
        echo "<p name=\"".$XMLdata->day_title[$index]['name']."\"><h1>".$XMLdata->day_title[$index]['name']."</h1><br><br></li></ul>";
        
        if ($index > 0)
        {
            $hashVector[$h] = $XMLdata->day_title[$index]->job[0]['id'];
        }
        else
        {
            $hashVector[$h] = $XMLdata->day_title[$index]->job[0]['id'];
        }
        ?>

        <div class="toggle">
            <div class="more" style="display:none">
                <div class="content">
                <form class="form" id="form" method="post" accept-charset="UTF-8">
                    <div class="tg-wrap">
                        
                        <table class="tg">
                            <tr>
                                <th class="tg-s6z1">
                                    <div class="field"><input name="NomeJob" id="NomeJob" autofocus type="text" maxlength="8" placeholder="nome job"></div></th>
                                <th class="tg-s6z2" rowspan="3">
                                    <div class="field"><textarea name="parametri" id="parametri" maxlength="250" wrap="hard" placeholder="parametri job"></textarea></div>   
                                </ 9th>
                                <th class="tg-031e" rowspan="3">
                                    <div class="field"><textarea name="nota" id="nota" wrap="hard" placeholder="nota"></textarea></div>
                                </th>
                                <th class="tg-s6zs" rowspan="3">
                                    <div class="field"><label for="sospeso">sospeso<br></label><br>
                                        <input name="sospeso" id="sospeso" type="radio" readonly value="true" checked="false" si/>no
                                        <input name="sospeso" id="sospeso" type="radio" readonly value="false" checked="yes">
                                    </div>
                                </th>
                                <th class="tg-s6zs" rowspan="3">
                                    <div class="field"><label for="ven">ven 2x<br></label>
                                        si<br>  <input name="ven2x" id="ven2x" type="radio" readonly value="true" checked="false">
                                        no      <input name="ven2x" id="ven2x" type="radio" readonly value="false" checked="yes">
                                    </div>
                                </th>
                                <th class="tg-s6zo" rowspan="3">
                                    <div class="field"><label for="inserisci"></label>
                                        <input name="inserisci_dopo" id="inserisci_dopo" type="submit" value="INSERT JOB" />
                                        <input type="hidden" name="inserisci_dopo" value="<?php echo "$hashVector[$h]"; ?>" />
                                        <input type="hidden" name="next" value="False" />
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td class="tg-s6z1">
                                    <div class="field"><input name="Libreria" id="Libreria" autofocus type="text" maxlength="2" placeholder="libreria"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tg-s6z1">
                                    <div class="field">
                                        <select name="Macro" id="Macro" required readonly>
                                        <option value="V10">&nbsp Italia V10&nbsp&nbsp</option>
                                        <option value="VDE">&nbsp Germania VDE&nbsp&nbsp</option>
                                        <option value="VES">&nbsp Spagna VES&nbsp&nbsp</option>
                                        <option value="VSW">&nbsp Svezia VSW&nbsp&nbsp</option>
                                        <option value="VFR">&nbsp Francia VFR&nbsp&nbsp</option>
                                        <option value="VBE">&nbsp Belgio VBE&nbsp&nbsp</option>
                                        <option value="VHK">&nbsp Hong Kong VHK&nbsp&nbsp</option>
                                        <option value="VAU">&nbsp Austria VAU&nbsp&nbsp</option>
                                        <option value="VNE">&nbsp Olanda VNE&nbsp&nbsp</option>
                                        <option value="VPT">&nbsp Portogallo VPT&nbsp&nbsp</option>
                                        <option value="VUK">&nbsp Inghilterra VUK&nbsp&nbsp</option>
                                        <option value="VCH">&nbsp SvizzeraVCH&nbsp&nbsp</option>
                                        <option value="VSL">&nbsp Slovenia VSL&nbsp&nbsp</option>
                                        <option value="VGE">&nbsp Est Europa VGE&nbsp&nbsp </option>
                                        <option value="VAF">&nbsp Sud Africa VAF&nbsp&nbsp</option>
                                        <option value="VMX">&nbsp Messico VMX&nbsp&nbsp</option>
                                        <option value="VHE">&nbsp Grecia VHE&nbsp&nbsp</option>
                                        <option value="VYA">&nbsp Dubai VYA&nbsp&nbsp</option>
                                        <option value="VUM">&nbsp Miami VUM&nbsp&nbsp</option>
                                    </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                       
                    </div> <!-- end #tg-wrap --> 
                            

                </form>
                </div> <!-- END .content -->
                
                
            </div> <!-- END .more -->

            <div class="less">
                <?php
                    if ($allow)
                    {
                ?>
                <a class="button-read-more button-read" href="#read"><img src="./images/add2_green.png" alt="INSERT JOB" height="16" width="16"></a>
                <a class="button-read-less button-read" href="#read"><img src="./images/hide_pink.png" alt="HIDE JOB" height="18" width="18"></a>
                <?php 
                    }
                ?>
            </div>

        </div> <!-- END .toggle -->
        
        
        <?php
        
        $tot = count($XMLdata->day_title[$index]->job);
        for ($indexJob=0; $indexJob < count($XMLdata->day_title[$index]->job); $indexJob++)
        {
            $checkSusp = get_bool((string)$XMLdata->day_title[$index]->job[$indexJob]->suspended);
            $false = "false";
            //var_dump($checkSusp);
            if ($checkSusp)
            {
                echo"<ul class=\"suspended\"><!-- ul job section -->";
            }
            else
            {
                echo"<ul> <!-- ul job section -->";
            }
        
        ?>
    
        
            <li id="id">
            <?php 
                
                $hash = $XMLdata->day_title[$index]->job[$indexJob]['id'];
                
                /*** display HASH CODE ***/
                //echo $XMLdata->day_title[$index]->job[$indexJob]['id'];
                
                /*** display blank***/
                echo "&nbsp";
                
            ?>
             
            </li>
            <li id="lib">
                <?php echo $XMLdata->day_title[$index]->job[$indexJob]->lib;        ?>
            </li>
            <li id="macro">
                <?php echo $XMLdata->day_title[$index]->job[$indexJob]->macro;      ?>
            </li>
            <li id="susp">
                &nbsp;           
            </li>
            <li id="ven">
            <?php
                $CheckVen = get_bool((string)$XMLdata->day_title[$index]->job[$indexJob]->ven2x);
                if($CheckVen)
                {
                    echo "2X";
                }
                else
                {
                    echo "&nbsp";
                }
            ?>
            </li>
            <li id="nome">
                <?php echo $XMLdata->day_title[$index]->job[$indexJob]->nome;           ?>
            </li>
            <li id="param">
                <?php echo $XMLdata->day_title[$index]->job[$indexJob]->param;          ?>
            </li>
            <li id="desc">
                <?php echo $XMLdata->day_title[$index]->job[$indexJob]->desc."&nbsp";   ?>
            </li>
            <li id="del" class="confirm">
                <?php
                    if ($allow)
                    {
                ?>
                <form id="formDELETE" method="POST">
                    <input type="image" src="./images/basket_pink.png" width="16" height="16" name="Del" id="Del" type="submit" value="Del" onclick="return(confirm('Eliminare questo job??'))">
                    <input type="hidden" class="formDELETE" name="Del" value="<?php echo "$hash"; ?>">
                </form>
                <?php
                    }
                ?>
            </li>
            <li id="edit">
                <?php //include('./includes/editJob.php');    ?>
                <!--
                <form method="POST" action="">
                    <input type="image" src="./images/edit.jpg" height="16" width="16" name="edit">
                    <input type="hidden" name="edit" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]['id']; ?>">
                    <input type="hidden" name="lib" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->lib; ?>">
                    <input type="hidden" name="macro" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->macro; ?>">
                    <input type="hidden" name="susp" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->suspended ?>">
                    <input type="hidden" name="nome" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->nome; ?>">
                    <input type="hidden" name="param" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->param; ?>">
                    <input type="hidden" name="desc" value="<?php //echo $XMLdata->day_title[$index]->job[$indexJob]->desc; ?>">
                </form>
                -->
                
                
                
        <div class="toggle-EDIT">
            <div class="more-EDIT" style="display:none">

                <div class="content">
                <form class="formEDIT" id="formEDIT" method="post" accept-charset="UTF-8">
                    
                
                <div class="tg-wrap">
                    <table class="tg">
                        <tr>
                            <th class="tg-s6z1"><div class="field"><input name="NomeJob" id="NomeJob" autofocus type="text" maxlength="8" value="<?php echo (string)$XMLdata->day_title[$index]->job[$indexJob]->nome; ?>"></div></th>
                            <th class="tg-s6z2" rowspan="3">
                                <div class="field"><textarea name="Parametri" id="Parametri" maxlength="250" wrap="hard"><?php echo (string)$XMLdata->day_title[$index]->job[$indexJob]->param; ?></textarea></div>
                            </th>
                            <th class="tg-031e" rowspan="3">
                                <div class="field"><textarea name="Nota" id="nota" wrap="hard" ><?php echo (string)$XMLdata->day_title[$index]->job[$indexJob]->desc; ?></textarea></div>
                            </th>
                            <th class="tg-s6zs" rowspan="3">
                                <div class="field"><label for="sospeso">sospeso<br></label>

                                    <?php
                                        $CheckSusp = get_bool((string)$XMLdata->day_title[$index]->job[$indexJob]->suspended);
                                        if($CheckSusp)
                                        {
                                    ?>
                                            si<br><input name="Sospeso" id="Sospeso" type="radio" value="true" checked>
                                            no<input name="Sospeso" id="Sospeso" type="radio" value ="false">
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                            si<br><input name="Sospeso" id="Sospeso" type="radio" value="true">
                                            no<input name="Sospeso" id="Sospeso" type="radio" value ="false" checked>
                                    <?php
                                        }
                                    ?>

                                </div>
                            </th>
                            <th class="tg-s6zs" rowspan="3">
                                <div class="field"><label for="ven2x">ven 2X<br></label>

                                    <?php
                                        $CheckVen2 = get_bool((string)$XMLdata->day_title[$index]->job[$indexJob]->ven2x);
                                        if($CheckVen2)
                                        {
                                    ?>
                                            si<br><input name="ven2x" id="ven2x" type="radio" value="true" checked>
                                            no<input name="ven2x" id="ven2x" type="radio" value ="false">
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                            si<br><input name="ven2x" id="ven2x" type="radio" value="true">
                                            no<input name="ven2x" id="ven2x" type="radio" value ="false" checked>
                                    <?php
                                        }
                                    ?>

                                </div>
                            </th>
                            <th class="tg-s6zo" rowspan="3">
                                <?php
                                    if ($allow)
                                    {
                                ?>
                                <div class="field"><label for="edita"></label>
                                    <input name="Edit" id="Edit" type="submit" value="SAVE EDIT">
                                    <input type="hidden" name="Edit" value="<?php echo $XMLdata->day_title[$index]->job[$indexJob]['id']; ?>">
                                </div>
                                <?php
                                    }
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <td class="tg-s6z1">
                                <div class="field"><input name="Libreria" id="Libreria" autofocus type="text" maxlength="2" value="<?php echo (string)$XMLdata->day_title[$index]->job[$indexJob]->lib; ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tg-s6z1">
                                <div class="field">
                                    <?php include ('select_macro.php') ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div> <!-- end #tg-wrap -->    
                        
            
                </form>
                </div> <!--  END #content -->
                
            </div> <!--  END #moreEDIT -->
    
            <div class="less-EDIT">
                <?php
                    if ($allow)
                    {
                ?>
                <a class="button-read-more-EDIT button-read" href="#read"><img src="./images/pencil_blue.png" alt="EDIT JOB" height="16" width="16"><a>
                <a class="button-read-less-EDIT button-read" href="#read"><img src="./images/hide_pink.png" alt="HIDE JOB" height="18" width="18"></a>
                <?php
                    }
                ?>
            </div>
    
        </div> <!--  END #toggleEDIT -->
                             
            </li>
        </ul> <!-- END ul job section -->
        
        
        <div class="toggle">
            <?php
            
                if ($indexJob == $tot-1)
                {
                    $hashIns = $XMLdata->day_title[$index]->job[$indexJob]['id'];
                }
                else
                {
                    $hashIns = $XMLdata->day_title[$index]->job[$indexJob]['id'];
                }
                
                /*** display HASH CODE ***/
                //echo $XMLdata->day_title[$index]->job[$indexJob]['id'];
                
                /*** display blank***/
                
                
           
            ?>
    
            <div class="more" style="display:none">
                <div class="content">
                <form class="form" id="form" method="post" accept-charset="UTF-8">
                    
                        <div class="tg-wrap">
                            
                            <table class="tg">
                                <tr>
                                    <th class="tg-s6z1">
                                        <div class="field"><input name="NomeJob" id="NomeJob" autofocus type="text" maxlength="8" placeholder="nome job"></div></th>
                                    <th class="tg-s6z2" rowspan="3">
                                        <div class="field"><textarea name="parametri" id="parametri" maxlength="250" wrap="hard" placeholder="parametri job"></textarea></div>   
                                    </th>
                                    <th class="tg-031e" rowspan="3">
                                        <div class="field"><textarea name="nota" id="nota" wrap="hard" placeholder="nota"></textarea></div>
                                    </th>
                                    <th class="tg-s6zs" rowspan="3">
                                    <div class="field"><label for="sospeso">sospeso<br></label>si<br><input name="sospeso" id="sospeso" type="radio" readonly value="true" checked="false">no<input name="sospeso" id="sospeso" type="radio" readonly value="false" checked="yes"></div>
                                    </th>
                                    <th class="tg-s6zs" rowspan="3">
                                    <div class="field"><label for="ven">ven 2x<br></label>si<br><input name="ven2x" id="ven2x" type="radio" readonly value="true" checked="false">no<input name="ven2x" id="ven2x" type="radio" readonly value="false" checked="yes"></div>
                                    </th>
                                    <th class="tg-s6zo" rowspan="3">
                                        <div class="field"><label for="inserisci"></label>
                                            <input name="inserisci_dopo" id="inserisci_dopo" type="submit" value="INSERT JOB">
                                            <input type="hidden" name="inserisci_dopo" value="<?php echo "$hashIns"; ?>">
                                            <input type="hidden" name="next" value="True">
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="tg-s6z1">
                                        <div class="field"><input name="Libreria" id="Libreria" autofocus type="text" maxlength="2" placeholder="libreria"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tg-s6z1">
                                        <div class="field">
                                            <select name="Macro" id="Macro" required readonly>
                                                <option value="V10">&nbsp Italia V10&nbsp&nbsp</option>
                                                <option value="VDE">&nbsp Germania VDE&nbsp&nbsp</option>
                                                <option value="VES">&nbsp Spagna VES&nbsp&nbsp</option>
                                                <option value="VSW">&nbsp Svezia VSW&nbsp&nbsp</option>
                                                <option value="VFR">&nbsp Francia VFR&nbsp&nbsp</option>
                                                <option value="VBE">&nbsp Belgio VBE&nbsp&nbsp</option>
                                                <option value="VHK">&nbsp Hong Kong VHK&nbsp&nbsp</option>
                                                <option value="VAU">&nbsp Austria VAU&nbsp&nbsp</option>
                                                <option value="VNE">&nbsp Olanda VNE&nbsp&nbsp</option>
                                                <option value="VPT">&nbsp Portogallo VPT&nbsp&nbsp</option>
                                                <option value="VUK">&nbsp Inghilterra VUK&nbsp&nbsp</option>
                                                <option value="VCH">&nbsp SvizzeraVCH&nbsp&nbsp</option>
                                                <option value="VSL">&nbsp Slovenia VSL&nbsp&nbsp</option>
                                                <option value="VGE">&nbsp Est Europa VGE&nbsp&nbsp </option>
                                                <option value="VAF">&nbsp Sud Africa VAF&nbsp&nbsp</option>
                                                <option value="VMX">&nbsp Messico VMX&nbsp&nbsp</option>
                                                <option value="VHE">&nbsp Grecia VHE&nbsp&nbsp</option>
                                                <option value="VYA">&nbsp Dubai VYA&nbsp&nbsp</option>
                                                <option value="VUM">&nbsp Miami VUM&nbsp&nbsp</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                        </div> <!-- end #tg-wrap --> 
                    
                </form>
                </div> <!-- END .content -->
            </div> <!-- END .more -->
            
            <div class="less">
                <?php
                    if ($allow)
                    {
                ?>
                <a class="button-read-more button-read" href="#read"><img src="./images/add2_green.png" alt="INSERT JOB" height="16" width="16"></a>
                <a class="button-read-less button-read" href="#read"><img src="./images/hide_pink.png" alt="HIDE JOB" height="18" width="18"></a>
                <?php
                    }
                ?>
            </div>
        </div> <!-- END .toggle -->
        
        
<?php      
        
        }
        $h++;
           
    }
    
?>

        
        
</article>

<div id="push-down"></div>

<script>

    function reset () 
        {
            $("#toggleCSS").attr("href", "./alertify/themes/alertify.default.css");
            alertify.set({labels : {ok : "OK", cancel : "Cancel"}, delay : 4000, buttonReverse : false, buttonFocus   : "ok"});
        }

    
    $(document).ready(function()
    {
        $(".confirm").on( 'click', function () 
        {
            reset();
            alertify.confirm("Sicuro di voler cancellare questo job?", function (e) 
            {
                if (e) 
                {
                    alertify.success("Job eliminato!");
                                    
                    $("#formDELETE").submit(function(e) {

                        //prevent Default functionality
                        e.preventDefault();
                        $(#formDELETE).trigger("submit");
                    });
                    

                } 
                else 
                {
                    alertify.error("Job non cancellato");
                }
            });
            return false;
        });
        
    });

</script>    
