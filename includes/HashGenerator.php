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
                <th <div class="field"><input name="Lib[]" id="Day" autofocus type="text" maxlength="2" placeholder="libreria" value="<?php if($Day != array()) {echo $Day[$y];} ?>"></div></th>
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


