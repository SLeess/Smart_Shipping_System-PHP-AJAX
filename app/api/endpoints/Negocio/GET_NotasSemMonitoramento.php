<?php
    require_once("../../../conexao.php");
    $pdo = PDO_Criar();

    $sql = "SELECT * from notas where id_monitoramento is null";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($resultados) > 0) {
        echo json_encode($resultados);
    } else {
        echo "none";
    }
?>