<?php
    session_start();
    if(empty($_SESSION)){
        print("<script>location.href='../index.html'</script>");
    }else if($_SESSION["tipo"] != 1){
        print("<script>alert('Acesso não autorizado!');location.href='home.php'</script>");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfis cadastrados</title>
    <link rel="shortcut icon" href="../_assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../_style/style.css">
    <!-- <link rel="stylesheet" href="../_style/navbar.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="../_scriptjs/script.js"></script>
    <style>
        .nav-pills .nav-link.active{
            background-color: #042ba3;
        }

        .dash{
            min-width: 80vw;
            /* min-height: 70vh; */
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

        /*nav li a:hover{
            background-color: red;
        }*/

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
        <div class="dash bg-white p-3">
            <div class="row">
                <?php
                    $relative = "";
                    $title = "- Lista de Perfis";
                    require_once("elements/tituloProjetoMainSection.php");
                ?>
            </div>
            <!-- table-responsive col-md-12 col-11 offset-1 offset-sm-0 p-2 -->
            <div class="row" id='users'>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="../_scriptjs/script_get_perfis.js"></script>
    <script src="../_scriptjs/script.js"></script>
</body>
</html>