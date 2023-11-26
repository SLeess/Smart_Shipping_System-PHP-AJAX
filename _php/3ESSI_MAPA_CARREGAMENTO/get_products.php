<?php
require_once("conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obter a data do POST
        $dataLancamento = isset($_POST['dataLancamento']) ? $_POST['dataLancamento'] : '';

        // Consulta SQL para buscar os dados necessários
        $sql = "SELECT
        p.id_monitoramento,
        p.cod,
        MAX(p.descricao) as descricao,
        MAX(p.nf) as nf,
        ROUND(SUM(p.quantidade),2) as Peso,
        SUM(P.QuantAux) as quantidade,
        MAX(p.data_producao) as data_producao,
        MAX(p.data_validade) as data_validade,
        MAX(n.fornecedor) as fornecedor
    FROM
        produtos p
    LEFT JOIN
        notas n ON p.nf = n.n_nota
    WHERE
        p.id_monitoramento IS NOT NULL
        AND n.Data_lancamento = :dataLancamento
    GROUP BY
        p.cod, p.id_monitoramento
    ORDER BY
        p.id_monitoramento, p.cod";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':dataLancamento', $dataLancamento);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json'); // Defina o cabeçalho para JSON

        if (count($produtos) > 0) {
            // Agrupe os resultados por id_monitoramento
            $produtosAgrupados = [];
            foreach ($produtos as $produto) {
                $id_monitoramento = $produto['id_monitoramento'];
                unset($produto['id_monitoramento']); // Remova o id_monitoramento do item individual
                $produtosAgrupados[$id_monitoramento][] = $produto;
            }

            echo json_encode($produtosAgrupados);
        } else {
            echo json_encode(["message" => "none"]); // Se não houver dados, retorne um JSON indicando isso
        }
        
        exit; // Adicione esta linha para evitar qualquer código adicional
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]); // Se houver um erro, retorne um JSON com a mensagem de erro
}

$pdo = null;
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motoristas & Caminhões</title>
    <link rel="shortcut icon" href="../../_assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../_style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Inclua o jQuery primeiro -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Em seguida, inclua os outros scripts -->
    <script src="../../_scriptjs/mapa.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script> -->
    <style>
        .nav-pills .nav-link.active{
            background-color: #042ba3;
        }
        .btns{
            display: block;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .dash{
            width: 60vw;
            height: 100%;
            margin: 10px auto;
            max-width: 920px;
            border-radius: 3px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }
        
        @media (max-width: 780px) {
            form h3{
                margin-top: 40px;
            }
        }
    </style>
</head>
<body>
    <?php
        $relative = "";
    ?>
    <div id="navbarSt"></div>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="dash col-lg-4 offset-lg-4 bg-white">
                <h2 style="text-align: center; font-size: 3.5em;">
                    <span class="fs-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                        3ESSI - Mapa de carregamento
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                    </span>
                </h2>
                <hr>
                <div class="container px-2 py-2" style="margin-bottom: 35px;">
                    <form method="POST" action="">
                        <div class="row g-4 py-2 row-cols-1 row-cols-lg-12">
                            <div class="col-md-12">
                                <label for="dataLancamento" class="form-label">Data de Lançamento:</label>
                                <input type="date" class="form-control" id="dataLancamento" name="dataLancamento" required>
                            </div>
                            <!-- Adicione outros campos conforme necessário -->
                            <div class="btns">
                                <button type="submit" class="btn btn-primary" id="btnBuscar">Buscar</button>
                            </div>
                            <div id="resultado"></div>

                        </div>
                    </form>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Remova a duplicata de mapa.js aqui -->
    <script src="../../_scriptjs/mapa.js"></script>
    <script>
        $(document).ready(() => {
            $.ajax({
                url: '../elements/navbarDD.php',
                type: 'POST',
                data: {
                    relative: '' // Passe o ID desejado aqui
                },
                success: (result) => {
                    $("#navbarSt").html(result);

                    // Adicione a classe "active" ao elemento desejado
                    $('#motoristas-tab').addClass('active');
                }
            });
        });
    </script>
</body>
</html>

