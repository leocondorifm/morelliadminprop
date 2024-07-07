<?php
function writeLN($text){
    $logFile = fopen("log.txt", 'a') or die("{'status':1,'message':'Error creando archivo'}");
    fwrite($logFile, "\n".date("d/m/Y H:i:s").": ".$text) or die("{'status':1,'message':'Error escribiendo en el archivo'}");
    fclose($logFile);
}