<?php
    session_start();
    if(empty($_SESSION)){
        echo 'index.html';
    }else if($_SESSION["tipo"] != 1){
        exit(-1);
    }
?>
<?php
    require_once("conexao.php");
    $conn = PDO_Criar();
    $sql = "UPDATE `usuarios` SET";
    if(isset($_POST['usuario'])){
        $pesquisa = $_POST['usuario'];
        $consulta = "SELECT * FROM usuarios WHERE `usuario` = '$pesquisa'";
        $req = $conn->prepare($consulta);
        $req->execute();
        $resposta = $req->fetchAll(PDO::FETCH_ASSOC);
        if (count($resposta) > 0) {
            if($pesquisa == $_SESSION['usuario'])
                echo json_encode(["message" => "same"]);
            else 
                echo json_encode(["message" => "exist"]);
            exit();
        }

        $sql .= " `usuario`='$pesquisa'";

    } else if(isset($_POST['tipo']) ){
        $sql .= " `tipo`='". $_POST['tipo'] . "'";
    } else if(isset($_POST['nome'])){
        $sql .= " `nome`='". $_POST['nome'] . "'";
    } else if(isset($_POST['email'])){
        $sql .= " `nome`='". $_POST['email'] . "'";
    }

    $sql .= " WHERE `id`=". $_POST['id'];

    try{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $perfis = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json'); // Defina o cabeçalho para JSON
            echo json_encode(['message' => $sql]);
        }
    } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
    }
    $pdo = null;
    //alert('Erro, usuário já cadastrado no sistema!');location.reload();
?>