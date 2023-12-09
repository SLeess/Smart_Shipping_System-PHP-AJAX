<?php
    require_once("../../conexao.php");
    $usuario = $_POST["usuario"];
    $conn = mysqli_criar();
    $nomeCompleto = $_POST["nome"]." ". trim($_POST["sobrenome"]);
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    $sql = "INSERT INTO `usuarios` (`nome`, `email`, `usuario`, `senha`, `tipo`, `data`) VALUES 
    ('$nomeCompleto', '$email', '$usuario', '$senha', '0', CURRENT_DATE())";
    
    if(mysqli_query($conn, $sql)){
        echo json_encode(["resposta" => true]);
    } else{
        echo json_encode(["resposta" => false]);
    }
?>