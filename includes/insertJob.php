
<?php

    
    if(isset($_POST['inserisci'])) 
    {
        $NomeJob = $_POST['NomeJob'];
        $Libreria = $_POST['Libreria'];
        $Macro = $_POST['Macro'];
        $parametri = $_POST['parametri'];
        $nota = $_POST['nota'];
        $sospeso = $_POST['sospeso'];
    }


?>

<div class="toggle">
    
    <div class="more" style="display:none">

        <form class="form" id="form" method="post" accept-charset="UTF-8">
            <div class="content">
                
                <div class="field"><input name="NomeJob" id="NomeJob" autofocus required type="text" maxlength="8" pattern="[A-Z][0-9]" placeholder="nome job"></div>
                <div class="field"><input name="Libreria" id="Libreria" autofocus required type="text" maxlength="2" pattern="[0-9]" placeholder="libreria"></div>
                    <div class="field">
                        <select name="Macro" id="Macro" required readonly>
                            <option value="V10">V10</option>
                            <option value="VDE">VDE</option>
                            <option value="VES">VES</option>
                            <option value="VSW">VSW</option>
                            <option value="VFR">VFR</option>
                        </select>
                    </div>
                <div class="field"><textarea name="parametri" id="parametri" required maxlength="250" wrap="hard" placeholder="parametri job"></textarea></div>
                <div class="field"><textarea name="nota" id="nota" wrap="hard" placeholder="nota"></textarea></div>
                    <div class="field"><label for="sospeso">sospeso&nbsp;</label><span>si</span><input name="sospeso" id="sospeso" type="radio" readonly value="si" checked="no"><span>no</span><input name="sospeso" id="sospeso" type="radio" readonly value="no" checked="yes"></div>
                    
                    <div class="field"><label for="inserisci"></label>
                        <input name="inserisci" id="inserisci" type="submit" value="insert new job">
                        <input type="hidden" name="inserisci" value="NomeJob,Libreria,Macro,parametri,nota,sospeso,<?php echo "$ID" ?>">
                    </div>
                
                
            </div>
        </form>
        
        
        
    </div>
    
    <div class="less">
        <a class="button-read-more button-read" href="#read"><img src="./images/PLUS.png" alt="INSERT JOB" height="16" width="16"><a>
        <a class="button-read-less button-read" href="#read"><img src="./images/MINUS.png" alt="HIDE JOB" height="16" width="16"></a>
    </div>
    
    
    
</div>
