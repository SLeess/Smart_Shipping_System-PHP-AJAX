<?php
    require_once("../3SSI-CRUD/conexao.php");

    $placa = $_POST['inscricaoPlaca']; 
    $modelo = $_POST['Modelo'];
    $nome = $_POST['inputNome'];
    $cpf = $_POST['inputCPF'];
    $habilitacao = $_POST['inputNumHabilitacao'];
    $data = $_POST['inputData'];

    $sqlMotoristas_Caminhoes = "CALL UpMotoristas_Caminhoes('$placa', '$modelo', '$nome', '$cpf', '$habilitacao', '$data')";

    $stmt = $pdo->prepare($sqlMotoristas_Caminhoes);
    try{
        $stmt->execute();
        $pdo = null;
        print("<script>alert('Dados inseridos com sucesso no banco de dados!');location.href='../motoristas_caminhoes.php';</script>");
    } catch(PDOException $err) {
        $pdo = null;
        print("<script>alert('Erro: Problemas na inserção de Motorista_Usuario. Erro gerado: " . $err->getMessage(). ");history.back(-1);</script>");
    }
    // header("Location: ../motoristas_caminhoes.php");
?>