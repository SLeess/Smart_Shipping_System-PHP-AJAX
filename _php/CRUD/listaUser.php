<?php
    require_once("conexao.php");
    // $placa = $_POST['inscricaoPlaca']; 

    $sql = "SELECT `id`, `nome`, `email`, `usuario`, `tipo`, `data` FROM `usuarios`";
    $conn = PDO_Criar();
    $stmt = $conn->prepare($sql);
    
    try{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $stmt->execute();
            $perfis = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json'); // Defina o cabeçalho para JSON

            if (count($perfis) > 0) {
                // Agrupe os resultados por id
                $perfisAgrupados = [];
                foreach ($perfis as $perfil) {
                    $id = $perfil['id'];
                    unset($perfil['id']); // Remova o id do item individual
                    $perfisAgrupados[$id][] = $perfil;
                }
                echo json_encode($perfis);
            } else {
                echo json_encode(["message" => "none"]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

$pdo = null;
?>