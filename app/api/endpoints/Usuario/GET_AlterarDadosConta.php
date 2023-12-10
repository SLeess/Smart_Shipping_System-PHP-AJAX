<?php
    //GET_AlterarDadosConta.php
    session_start();
    if(empty($_SESSION)){
        echo json_encode(["session" => "vazio"]);
    }
    require_once("../../../conexao.php");
    $conn = mysqli_criar();
?>
<?php
    $usuario = $_POST["usuario"];
    $oldUsuario = $_SESSION['usuario'];

    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resposta = $conn->query($consulta);
    if ($resposta->num_rows > 0 || $usuario == $_SESSION['usuario']) {
        echo json_encode(["session" => "already"]);
        exit();
    }

    $nome = $_POST["nome"]. " ". $_POST["sobrenome"];
    $email = $_POST["email"];

    $sql = "UPDATE `usuarios` SET `usuario` = '$usuario', `nome` = '$nome', `email` = '$email' WHERE `usuarios`.`usuario` = '$oldUsuario'";    
    if ($conn->query($sql)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        echo json_encode(["session" => true]);
    } else{
        echo json_encode(["session" => false]);
    }

?>