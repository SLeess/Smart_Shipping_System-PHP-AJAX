<?php
    require_once("conexao.php");

    $sql = "UPDATE `usuarios` SET `tipo`=". $_POST['tipo']."WHERE `id`=". $_POST['usuario'];
    $conn = PDO_Criar();
    $stmt = $conn->prepare($sql);

    try{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $stmt->execute();
            $perfis = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json'); // Defina o cabeçalho para JSON
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

    $pdo = null;
?>