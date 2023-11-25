<?php
    require_once("../3ESSICRUD/conexao.php");
    $costume = isset($_POST['where']) ? $_POST['where'] : null;

    $sql = "SELECT * from notas where id_monitoramento is null";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($resultados) > 0) {
        // echo var_dump($resultados);
        echo json_encode($resultados);
    } else {
        echo "none";
    }
?>