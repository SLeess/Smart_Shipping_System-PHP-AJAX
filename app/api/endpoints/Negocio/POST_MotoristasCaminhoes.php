<?php
session_start();

if ($_SESSION['tipo'] != 1) {
    exit(-1);
}

require_once("../../../conexao.php");
$pdo = PDO_Criar();

$placa = $_POST['inscricaoPlaca'];
$modelo = $_POST['Modelo'];
$nome = $_POST['inputNome'];
$cpf = $_POST['inputCPF'];
$habilitacao = $_POST['inputNumHabilitacao'];
$data = $_POST['inputData'];
$senha = md5($_POST['inputSenha']);

if ($senha != $_SESSION['senha']) {
    $pdo = null;
    $response = ['error' => 'Senha da conta incorreta!'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(-1);
}

$sqlMotoristas_Caminhoes = "CALL UpMotoristas_Caminhoes('$placa', '$modelo', '$nome', '$cpf', '$habilitacao', '$data')";

$stmt = $pdo->prepare($sqlMotoristas_Caminhoes);
try {
    $stmt->execute();
    $response = ['message' => 'Dados inseridos com sucesso no banco de dados!'];
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (PDOException $err) {
    $response = ['error' => 'Erro: Problemas na inserção de Motorista_Usuario. Erro gerado: ' . $err->getMessage()];
    header('Content-Type: application/json');
    echo json_encode($response);
} finally {
    $pdo = null;
}
?>
