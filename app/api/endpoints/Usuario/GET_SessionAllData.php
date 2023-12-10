<?php
    session_start();
    if(empty($_SESSION)){
        echo json_encode(["session" => false]);
    } else{
        require_once("POST_Relog.php");
        
        $nome = ""; $sobrenome = "";
        $i = 0;
        for(;$i < strlen($_SESSION['nome']); $i++){
            if($_SESSION['nome'][$i] == " ") break;
            $nome .= $_SESSION['nome'][$i];
        }
        $i++;
        for(;$i < strlen($_SESSION['nome']); $i++){
            $sobrenome .= $_SESSION['nome'][$i];
        }

        if($verific == 0) echo json_encode(["session" => ["usuario" => $_SESSION['usuario'], "permissao" => $_SESSION['tipo'], "nome" => $nome, "sobrenome" => $sobrenome, "email" => $_SESSION['email'], "data" => $_SESSION["data"]]]);
    }
?>