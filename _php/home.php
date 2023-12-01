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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="../_scriptjs/script.js"></script>
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
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo amet vel praesentium corrupti, fugit doloremque, delectus natus ratione assumenda aut porro quis unde error deserunt animi laudantium? Accusantium, dolore odio.
                </p>
                <br style="margin-bottom: 20px;">
                <br><br><br><br><br><br><br>
                <hr>
                <h4 style="text-align: center;">Novidades</h4>
                <div id="carouselExampleAutoplaying" class="row carousel slide col-md-10 offset-md-1 col-lg-12 offset-lg-0 offset-0 col-12 mt-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="https://assets-global.website-files.com/5e1cab8214cecfc49d37df0a/5e2f16f45fd72a805f7121af_blog-caminhao-frigorifico-fretefy.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="https://assets-global.website-files.com/5e1cab8214cecfc49d37df0a/5e2f16f45fd72a805f7121af_blog-caminhao-frigorifico-fretefy.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="https://assets-global.website-files.com/5e1cab8214cecfc49d37df0a/5e2f16f45fd72a805f7121af_blog-caminhao-frigorifico-fretefy.jpeg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../_scriptjs/script.js"></script>
    <script>
        $(document).ready(() => {
            $.ajax({
                url: 'elements/E_navbar.php',
                type: 'POST',
                data: {
                    relative: '' // Passe o ID desejado aqui
                },
                success: (result) => {
                    $("#navbarSt").html(result);
                }
            });
        });
    </script>
</body>
</html>