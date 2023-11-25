<?php
    require_once('conexao.php');

    $sql = "SELECT * from notas where id_monitoramento is null";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($resultados) > 0) {
        echo json_decode($resultados);
    } else {
        echo "none";
    }
?>