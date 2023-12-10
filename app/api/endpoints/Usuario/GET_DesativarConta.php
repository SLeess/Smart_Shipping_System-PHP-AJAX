<?php
    session_start();
    if(empty($_SESSION)){
        echo json_encode(["session" => "vazio"]);
    }
    
    $usuario = $_SESSION["usuario"];
    
    require_once("../../../conexao.php");
    $conn = mysqli_criar();
?>
<?php
    function executarExclusao($conexao, $sentenca){
        if (mysqli_query($conexao, $sentenca)) {
            echo json_encode(["session" => true]);
        } else{
            echo json_encode(["session" => false]);
        }
    }

    $sql = "UPDATE `usuarios` SET `usuario` = '#$usuario' WHERE `usuarios`.`usuario` = '$usuario'";
    executarExclusao($conn, $sql);
?>