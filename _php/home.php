<?php
    session_start();
    if(empty($_SESSION)){
        print("<script>location.href='../index.html'</script>");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="shortcut icon" href="../_assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../_style/style.css">
    <!-- <link rel="stylesheet" href="../_style/navbar.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../_scriptjs/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        .nav-pills .nav-link.active{
            background-color: #042ba3;
        }
        <?php echo "nav{
            background-color: #333;
            margin-bottom: 2em;
        }

        nav li{
            display: inline-block;
        }

        nav li a{
            color: #fff;
            text-decoration: none;
            padding: 15px;
            display: inline-block;
            transition: all 0.5s;
        }

        nav li a:hover{
            background-color: red;
        }

        .dropdown-menu{
            position: absolute;
            display: none;
        }

        .dropdown-menu a{
            display: block;
        }

        .dropdown:hover .dropdown-menu{
            display: block;
            margin-top: 2px;
        }";
        
        ?>
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
                    $title = "- Página Inicial";
                    require_once("elements/tituloProjetoMainSection.php");
                ?>
                <p>
                    Bem vindo a página inicial do sistema! <br><Br>Aqui pode ser feito o controle de dados fiscais a cerca dos serviços prestados pela empresa de entregas. Além disso, contamos com um sistema de controle de Motoristas, de Caminhões sendo utilizados.
                </p>
                <hr>
                <p>
                    Visualize a barra lateral para ver as opções de menus a serem trabalhados.
                </p>
                <hr>
                <br style="margin-bottom: 20px;">
                <h4 style="text-align: center;">Novidades</h4>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../_scriptjs/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            $.ajax({
                url: 'elements/navbarDD.php',
                type: 'POST',
                data: {
                    relative: '' // Passe o ID desejado aqui
                },
                success: (result) => {
                    $("#navbarSt").html(result);

                    // Adicione a classe "active" ao elemento desejado
                    $('#home-tab').addClass('active');
                }
            });
        });
    </script>
</body>
</html>