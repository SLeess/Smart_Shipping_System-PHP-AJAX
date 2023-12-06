<?php
    $relative = "../";
    require_once($relative."CRUD/relog.php");
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
        <?php 
            require("../elements/cssNavbar.php");
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
                    require_once($relative. "elements/tituloProjetoMainSection.php");
                ?>
            </div>
            <div id="motorist_caminho"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(()=>{
            $.ajax({
                url: '../3ESSI_MOTORIST_CAMINHOES/control_view_motoristas_caminhoes.php',
                type: 'POST',
                data:{

                },
                success: (resposts) => {
                    var confirm ='';
                    for (const row of resposts) {
                        confirm += `<button class='btn btn-outline-primary px-2 mx-3' onclick='selecionarCaminhao("${row['placa_caminhao']}", "${row['cpf_motorista']}" , ${id_monitoramento})'>${row['placa_caminhao']} - ${row['nome_motorista']}</button>`;
                    };
                    $("#motorist_caminho").html(confirm);
                }
            });
        });

        function getUrlParameter(name) {
            name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Capturar o id_monitoramento da URL usando a função getUrlParameter
        var id_monitoramento = getUrlParameter('id_monitoramento');

        function selecionarCaminhao(placa, cpf, id_monitoramento) {
            $.ajax({
                url: 'AlteraPlaca.php',
                type: 'POST',
                data: {
                    placa: placa,
                    cpf: cpf,
                    id_monitoramento: id_monitoramento
                },
                success: function(response) {
                    console.log(response);

                    // Após a resposta bem-sucedida, redirecionar para a view_gerar_monitoramento.php
                    alert("Monitoramento criado com sucesso!");
                    window.location.href = 'view_get_notas.php';
                }
            });
        }
    </script>
</body>
</html>
