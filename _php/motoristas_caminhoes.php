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
    <title>Motoristas & Caminhões</title>
    <link rel="shortcut icon" href="../_assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../_style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../_scriptjs/script.js"></script>
    <script src="../_scriptjs/motorist-caminhao.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script> -->
    <style>
        .btns{
            display: block;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .dash{
            width: 60vw;
            /* margin: auto; */
            margin: 40px auto;
            max-width: 920px;
            min-height: 420px;
            min-width: 400px;
            max-height: 5200px;
            border-radius: 3px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }
        .sidebar{
            min-height: 100vh;
            box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
            max-height: 100vh;
        }
        @media (max-width: 995px) {
            .dash {
                min-height: 720px;
                height: 1800px;
                margin-bottom: 35px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler bg-body-tertiary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!--text-bg-dark-->
                <main class="sidebar d-flex flex-column flex-shrink-0 p-3">
                    <!--text-white-->
                    <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-black text-decoration-none">
                        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                        <span class="fs-4">Sistema
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                                <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                            </svg>
                        </span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <!--colocar active quando tiver selecionado ::hover-->
                            <!--text-white-->
                            <a href="home.php" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                                    <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                                    <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                &nbsp;Página inicial
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="3SSI-CRUD/notas.php" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-bar-graph" viewBox="0 0 16 16">
                                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z"/>
                                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                </svg>
                                &nbsp;Notas Fiscais
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="#" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                                &nbsp;Motoristas & Caminhões
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="#" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                </svg>
                                &nbsp;Produtos
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="#" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                                &nbsp;Visualizar Clientes
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <!--text-white-->
                        <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://cdn-icons-png.flaticon.com/256/6596/6596121.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>
                                <?php
                                    print($_SESSION['usuario']);
                                ?>
                            </strong>
                        </a>
                        <!--dropdown-menu-dark-->
                        <ul class="dropdown-menu text-small shadow" style="margin-top: -220px;">
                            <li><a class="dropdown-item" href="perfil_configs.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configurações</a></li>
                            <li><a class="dropdown-item" href="#">FAQ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="CRUD/logout.php">Sair</a></li>
                        </ul>
                    </div>
                </main>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
    </nav>
    
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="dash col-lg-4 offset-lg-4 bg-white">
                <h2 style="text-align: center; font-size: 3.5em;">
                    <span class="fs-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                        3ESSI - Cadastro de Motoristas e Caminhões
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                    </span>
                </h2>
                <hr>
                <div class="container px-2 py-2" style="margin-bottom: 35px;">
                    <div class="row g-4 py-2 row-cols-1 row-cols-lg-12">
                        <form action="3ESSI-MOTORIST-CAMINHOES/gravarMotorista.php" method="POST" class="d-flex">
                            <div class="col-6">
                                <h3>Cadastrar Motorista</h3>
                                <div class="col-md-8">
                                    <label for="inputText4" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Nome do Motorista">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="inputText4" class="form-label">CPF</label>
                                    <!-- <input type="text" class="form-control" id="inputCPF" name="inputCPF" placeholder="CPF do Motorista"> -->
                                    <input type="text" name="inputCPF" id="inputCPF" class="form-control" maxlength="14" placeholder="CPF do Motorista" oninput="formatarCPF(this)" required pattern="\d{11}\" title="000.000.000-00">
                                </div>
                                <div class="col-md-9 mt-4">
                                    <label for="inputText4" class="form-label">N° de Habilitação</label>
                                    <input type="text" class="form-control" id="inputNumHabilitacao" name="inputNumHabilitacao" placeholder="Número de Habilitação" maxlength="8">
                                </div>
                                <div class="col-md-9 mt-3">
                                    <label for="inputAddress2" class="form-label">Data de Vencimento da Habilitação</label>
                                    <input type="date" class="form-control" id="inputData" name="inputData" placeholder="01/01/2023">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <h3>Cadastrar Caminhão</h3>
                                <div class="col-md-5">
                                    <label for="inputPlaca" class="form-label">Inscrição da Placa</label>
                                    <input type="text" class="form-control" name="inscricaoPlaca" id="inputPlaca" placeholder="Valor da Placa" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="inputModelo" class="form-label">Modelo de Veículo</label>
                                    <select id="inputModelo" name="Modelo" class="form-select" value="Modelo" required>
                                        <option>Selecione o Modelo</option>
                                        <option selected value="T">Toco</option>
                                        <option value="B">Truco</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-5 mt-3">
                                    <label for="inputZip" class="form-label">Senha do Adm</label>
                                    <input type="password" class="form-control" id="inputSenha" required>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <p class="form-check-label" for="gridCheck">
                                        Confirmar veracidade dos dados acima
                                    </p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="removerMascaraCPF(document.getElementById('inputCPF'));formatData(document.getElementById('inputData'));">
                                        Inserir Motorista-Caminhão
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../_scriptjs/script.js"></script>
    <script>
        // $("#tfTelefone").mask("(99) 99999-9999");
        // $("#tfCEP").mask("99999-999");
        // $("#inputCPF").mask("999.999.999-99");
    </script>
</body>
</html>