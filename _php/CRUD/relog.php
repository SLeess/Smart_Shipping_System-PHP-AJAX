<?php
    session_start();
    $usuario = $_SESSION['usuario'];
    $senha = $_SESSION['senha'];
    include("conexao.php");
    $conn = mysqli_criar();
    $sqlBusca = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND senha = '{$senha}'";
    $res = mysqli_query($conn, $sqlBusca);
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
        print("<script>location.href='../home.php';</script>");
    } else{
        print("<script>alert('Usuário e/ou senha incorreto(s)');location.href='../../index.html';</script>");
    }
?>