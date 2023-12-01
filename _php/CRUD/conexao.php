<?php
$HOST = "localhost";
$USER = "root";
$PASS = "";
$BASE = "sislogin";

function mysqli_criar(){
    return mysqli_connect($GLOBALS['HOST'], $GLOBALS['USER'], $GLOBALS['PASS'], $GLOBALS['BASE']);
}

function PDO_Criar(){
    return new PDO("mysql:host=".$GLOBALS['HOST'].";dbname=".$GLOBALS['BASE'], $GLOBALS['USER'], $GLOBALS['PASS']);
}
?>