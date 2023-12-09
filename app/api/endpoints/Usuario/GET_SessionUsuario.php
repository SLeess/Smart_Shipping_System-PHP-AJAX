<?php
    session_start();
    if(empty($_POST)){
        echo json_encode(["session" => false]);
    }
    echo json_encode(["session" => ["usuario" => $_SESSION['usuario'], "permissao" => $_SESSION['tipo']]]);
?>