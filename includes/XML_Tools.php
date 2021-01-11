<div style="margin-top: 40px;"></div>
<?php

    
    $hash = array();
    $Day = array();
    $Lib = array();
    $Macro = array();
    $JobName = array();
    
    if (isset($_POST['hashGen']))
    {
        $Day = $_POST['Day'];
        $Lib = $_POST['Lib'];
        $Macro = $_POST['Macro'];
        $JobName = $_POST['NomeJob'];
        for ($i = 0; $i < count($_POST['Lib']); $i++ )
        {
            $hash[$i] = md5($Day[i].$Lib[$i].$Macro[$i].$JobName[$i]);
            //echo "lib: ".$Lib[$i]." macro: ".$Macro[$i]." job: ".$JobName[$i]." hash: ".$hash[$i]."<br>";
        }
        //echo var_dump($Lib);
    }
    
    if (isset($_POST['pulisci']))
    {
        for($i=0; $i < count($Lib); $i++)
        {
            $Day[$i] = array();
            $Lib[$i] = array();
            $Macro[$i] = array();
            $JobName[$i] = array();
            $hash[$i] = array();
        }
    }


?>

<div style="margin-top: 40px;"></div>
<p>Hash Generator</p>
<br>
<form id="form" method="post" accept-charset="UTF-8">
    <table>
        
        <?php
        for ($y=0; $y < 20; $y++)
        {
        ?>
            <tr>
                <th <div class="field"><input name="Lib[]" id="Day" autofocus type="text" maxlength="20" placeholder="giornata" value="<?php if($Day != array()) {echo $Day[$y];} ?>"></div></th>
                <th <div class="field"><input name="Lib[]" id="Lib" autofocus type="text" maxlength="2" placeholder="libreria" value="<?php if($Lib != array()) {echo $Lib[$y];} ?>"></div></th>
                <th <div class="field"><input name="Macro[]" id="Macro" autofocus type="text" maxlength="4" placeholder="macro" value="<?php if($Macro != array()) {echo $Macro[$y];} ?>"></div></th>
                <th <div class="field"><input name="NomeJob[]" id="NomeJob" autofocus type="text" maxlength="8" placeholder="nome job" value="<?php if($JobName != array()) {echo $JobName[$y];} ?>"></div></th>
                <th <div class="field"><input name="HASH[]" size="100%" id="hash" value="<?php if($hash != array()) {echo $hash[$y];} ?>"></div></th>
            </tr>
        <?php 
        }
        ?>
        
    </table> 

    <BR>    
    <div <label for="inserisci"></label>
        <input name="hashGen" id="hashGen" type="submit" value="genera Hash">
        <input type="hidden" name="hashGen" value="Lib,Macro,NomeJob">
        <input type="hidden" name="next" value="False">
    </div>
</form>
<BR> 
<form id="formClear" method="post" accept-charset="UTF-8">
    <div <label for="pulisci"></label>
        <input name="pulisci" id="pulisci" type="submit" value="pulisci">
        <input type="hidden" name="pulisci" value="">
        <input type="hidden" name="next" value="False">
    </div>

</form>
<br><br><br><br>

<?php

if(isset($_POST['editXML']))
{
    $theBook = $_POST['Book'];
    switch ($theBook)
    {
        case "LibroItalia":
            $file = ".\dataXML\LibroItalia.xml";
            break;
        case "LibroFiliali":
            $file = ".\dataXML\LibroFiliali.xml";
            break;
        case "LibroPiano":
            $file = ".\dataXML\LibroPiano.xml";
            break;
    }
    
    $Child = $_POST['Child'];
    $Value = $_POST['Value'];
    editXML($file,$Child,$Value);
}

if(isset($_POST['updateHash']))
{
    $theBook = $_POST['Book'];
    switch ($theBook)
    {
        case "LibroItalia":
            $file = ".\dataXML\LibroItalia.xml";
            break;
        case "LibroFiliali":
            $file = ".\dataXML\LibroFiliali.xml";
            break;
        case "LibroPiano":
            $file = ".\dataXML\LibroPiano.xml";
            break;
    }
    
    updateHASH($file);
}



function editXML($file,$Child,$Value) {
        
    //var_dump($newJob);

    $tempXML = simplexml_load_file($file);

    //var_dump($tempXML);

    for ($i=0; $i < count($tempXML); $i++)
    {
        for ($y=0; $y < count($tempXML->day_title[$i]->job); $y++)
        {
            $tempXML->day_title[$i]->job[$y]->addChild($Child,$Value);
        }
    }


    //print_r(simplexml_import_dom($tempXML->day_title[$i]->job[$y]['id']));

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($tempXML->asXML());
    $dom->saveXML();
    $dom->save($file);
    
    echo "inserito nuovo nodo!";

    return $tempXML;
        
}


function updateHASH($file) {
    
    $tempXML = simplexml_load_file($file);

    //var_dump($tempXML);

    for ($i=0; $i < count($tempXML); $i++)
    {
        $Day = $tempXML->day_title[$i];
        for ($y=0; $y < count($tempXML->day_title[$i]->job); $y++)
        {
            $Lib = $tempXML->day_title[$i]->job[$y]->lib;
            $Macro = $tempXML->day_title[$i]->job[$y]->macro;
            $Nome = $tempXML->day_title[$i]->job[$y]->nome;        
            $tempXML->day_title[$i]->job[$y]['id'] = md5($Day.$Lib.$Macro.$Nome);
        }
    }
    
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($tempXML->asXML());
    $dom->saveXML();
    $dom->save($file);
    
    echo "MD5 HASH job aggiornati!";

    return $tempXML;
    
}

    
?>

<div style="margin-top: 40px;"></div>
<p>XML EDITOR</p>
<br><br><br>
<p>insert new node (child)</p><br>
<form id="form" method="post" accept-charset="UTF-8">
    <table>
        <tr>
            <th <div class="field">
            <select name="Book" id="Macro" required readonly>
                <option value="LibroItalia">&nbsp Libro Italia&nbsp&nbsp</option>
                <option value="LibroFiliali">&nbsp Libro Filiali&nbsp&nbsp</option>
                <option value="LibroPiano">&nbsp Libro Piano&nbsp&nbsp</option>
            </select>
            </th></div>
            <th <div class="field"><input name="Child" id="Child" autofocus type="text" maxlength="10" placeholder="child" value=""></div></th>
            <th <div class="field"><input name="Value" id="Value" autofocus type="text" maxlength="10" placeholder="value" value=""></div></th>
        </tr>
    </table> 
    <BR>    
    <div <label for="inserisci"></label>
        <input name="editXML" id="editXML" type="submit" value="insert new child">
        <input type="hidden" name="editXML" value="Book,Child,Value">
        <input type="hidden" name="next" value="False">
    </div>
</form>
<BR> 
<form id="formClear" method="post" accept-charset="UTF-8">
    <div <label for="pulisci"></label>
        <input name="pulisci" id="pulisci" type="submit" value="pulisci">
        <input type="hidden" name="pulisci" value="">
        <input type="hidden" name="next" value="False">
    </div>

</form>

<br><br><br>
<p>update Hash job</p><br>
<form id="form" method="post" accept-charset="UTF-8">
    <div>
        <select name="Book" id="Macro" required readonly>
            <option value="LibroItalia">&nbsp Libro Italia&nbsp&nbsp</option>
            <option value="LibroFiliali">&nbsp Libro Filiali&nbsp&nbsp</option>
            <option value="LibroPiano">&nbsp Libro Piano&nbsp&nbsp</option>
        </select>
    </div>
    <BR>
    <div <label for="updateHAsh"></label>
        <input name="updateHash" id="updateHash" type="submit" value="update MD5 HASH job">
        <input type="hidden" name="updateHash" value="Book">
        <input type="hidden" name="next" value="False">
    </div>
</form>
