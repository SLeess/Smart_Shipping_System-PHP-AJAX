<?php
    session_start();
    if(empty($_POST) or (empty($_POST['usuario'])) or (empty($_POST['senha']))){
        echo json_encode(["resposta" => false]);
    }
    require_once("../../../conexao.php");
    $conn = mysqli_criar();
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND senha = '{$senha}'";
    $res = mysqli_query($conn, $sql);

    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    if($qtd){
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nome"] = $row->nome;
        $_SESSION["tipo"] = $row->tipo;
        $_SESSION["email"] = $row->email;
        $_SESSION["data"] = $row->data;
        $_SESSION["id"] = $row->id;
        $_SESSION["senha"] = $row->senha;
        echo json_encode(["resposta" => true]);
    } else{
        echo json_encode(["resposta" => "incorrect"]);
    }
    
?>