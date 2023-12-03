<?php
    session_start();
    if(empty($_SESSION)){
        print("<script>location.href='../../index.html'</script>");
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../_scriptjs/script_get_products.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <style>
        // ... (estilos CSS)

        <?php
            echo "nav {
                background-color: #333;
                margin-bottom: 2em;
            }

            nav li {
                display: inline-block;
            }

            nav li a {
                color: #fff;
                text-decoration: none;
                padding: 15px;
                display: inline-block;
                transition: all 0.5s;
            }

            nav li a:hover {
                background-color: red;
            }

            .dropdown-menu {
                position: absolute;
                display: none;
            }

            .dropdown-menu a {
                display: block;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 2px;
            }";
        ?>
    </style>
</head>
<body>
    <div id="navbarSt"></div>
    <div class="container d-flex justify-content-center align-items-center">
        <div id="dash" class="inicial dash bg-white p-4 col-12">
            <div class="row">
                <?php
                    $title = "- Mapa de carregamento";
                    require_once("../elements/tituloProjetoMainSection.php");
                ?>
            </div>
            <div id="resultado"></div>

            <?php
                // Realizar a consulta no banco para obter modelos e placas
                require_once("../3SSI_CRUD/conexao.php");
                $id_monitoramento = isset($_GET['id_monitoramento']) ? $_GET['id_monitoramento'] : null;

                try {
                    $sql = "SELECT * FROM caminhoes";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Exibir os resultados
                    if ($result) {
                        foreach ($result as $row) {
                            // Adicionar o ID da URL como um parâmetro na função selecionarCaminhao
                            echo "<button class='btn btn-outline-primary' onclick='selecionarCaminhao(\"{$row['placa']}\", {$id_monitoramento})'>{$row['placa']}</button>";
                        }
                    } else {
                        echo "Nenhum caminhão encontrado.";
                    }
                } catch (PDOException $e) {
                    echo json_encode(["error" => $e->getMessage()]);
                }

                $pdo = null;
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <!-- <script src="../../_scriptjs/script_get_products.js"></script> -->

    <script>
        function getUrlParameter(name) {
            name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Capturar o id_monitoramento da URL usando a função getUrlParameter
        var id_monitoramento = getUrlParameter('id_monitoramento');

        function selecionarCaminhao(placa, id_monitoramento) {
            $.ajax({
                url: 'AlteraPlaca.php',
                type: 'POST',
                data: {
                    placa: placa,
                    id_monitoramento: id_monitoramento
                },
                success: function(response) {
                    console.log(response);

                    // Após a resposta bem-sucedida, redirecionar para a view_gerar_monitoramento.php
                    window.location.href = 'view_get_notas.php';
                }
            });
        }

        // ... (restante do script) ...
    </script>
</body>
</html>
