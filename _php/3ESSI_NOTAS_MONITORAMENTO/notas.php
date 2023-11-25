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
    <title>Lista de notas</title>
    <link rel="shortcut icon" href="../../_assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../_style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../../_scriptjs/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        .nav-pills .nav-link.active{
            background-color: #042ba3;
        }
        .dash{
            min-height: 90vh;
            height: 100%;
        }
        .form-control{
            display: inline;
            width: auto;
        }
    </style>
</head>
<body>    
    <div id="navbarSt"></div>
    <div class="container d-flex justify-content-center align-items-center">
        <!-- col-lg-4 offset-lg-4 -->
        <div class="dash bg-white">
            <div class="row p-3">
                <?php
                    $relative = "";
                    $title = "- Tabelas de Notas sem Monitoramento";
                    require_once("../elements/tituloProjetoMainSection.php");
                    require_once("../elements/filtroBusca.php");
                ?>
            </div>
            <div class="row p-3">
                <div id="table" style="max-width: 60%;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../_scriptjs/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../_scriptjs/buscarNotas.js"></script>
</body>
</html>