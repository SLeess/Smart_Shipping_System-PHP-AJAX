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
            height: 100%;
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
                ?>
                <div id="table"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../_scriptjs/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            $.ajax({
                url: '../elements/navbarDD.php',
                type: 'POST',
                data: {
                    relative: '../' // Passe o ID desejado aqui
                },
                success: (result) => {
                    $("#navbarSt").html(result);

                    // Adicione a classe "active" ao elemento desejado
                    // $('#home-tab').addClass('active');
                }
            });
            $.ajax({
                url: 'consultaNotas.php',
                type: 'POST',
                data: {
                    where: "teste"
                },
                success: (result) => {
                    dados = JSON.parse(result);
                    var confirm;
                    if(dados.length === 0){
                        confirm = "<p style='text-align: center;'>O Banco não possui nenhuma nota sem monitoramento ativo</p>";
                    } else{
                        confirm = "<table class='table'><thead><tr><th scope='col'>#</th><th scope='col'>N° Nota</th><th scope='col'>Cliente</th><th scope='col'>Município</th><th scope='col'>Fornecedor</th><th scope='col'>Peso_Bruto</th></tr></thead><tbody>";
                        for(i = 0; i < dados.length; i++){
                            confirm+= "<tr>";
                            confirm += "<th scope='row'>"+ (parseInt(i) + 1) +"</th>";
                            confirm += ("<td>"+dados[i]['n_nota']+"</td>"); 
                            confirm += ("<td>"+dados[i]['Cliente']+"</td>"); 
                            confirm += ("<td>"+dados[i]['municipio']+"</td>"); 
                            confirm += ("<td>"+dados[i]['fornecedor']+"</td>"); 
                            confirm += ("<td>"+dados[i]['peso_bruto']+"</td>"); 
                            confirm+= "</tr>";
                        }
                        confirm += "</tbody></table>";
                    }
                    $("#table").html(confirm);
                }
            });
        });
    </script>
</body>
</html>