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
    <title>Notas e Monitoramento</title>
    <link rel="shortcut icon" href="../../_assets/favicon.ico" type="image/x-icon">
    <link href="../../_style/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../../_scriptjs/script.js"></script>
    <script src="../../_scriptjs/notas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        input[type=data], input[type=date]{
            margin: 5px 0;
        }

        .btns{
            margin-top: 35px;
            margin-bottom: 10px;
        }

        .btns,
        input{
            width: 100%;
        }

        h2{
            margin-bottom: 30px;
        }

        .dash{
            width: 60vw;
            height: 87vh;
            margin: auto;
            margin-top: 40px;
            max-width: 920px;
            min-height: 420px;
            min-width: 400px;
            max-height: 1200px;
            border-radius: 3px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }
        
        @media (max-width: 995px) {
            .dash {
                min-height: 720px;
                height: 900px;
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
                <main class="sidebar d-flex flex-column flex-shrink-0 p-3" style="min-height: 100vh; box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px; max-height: 100vh;">
                    <!--text-white-->
                    <a href="../home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-black text-decoration-none">
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
                            <a href="../home.php" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                                    <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                                    <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                &nbsp;Página inicial
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="#" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-bar-graph" viewBox="0 0 16 16">
                                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z"/>
                                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                </svg>
                                &nbsp;Notas Fiscais
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--text-white-->
                            <a href="../motoristas_caminhoes.php" class="nav-link text-black" aria-current="page" onmouseenter="sobre(this, 1);" onmouseleave="sobre(this,0)">
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
                            <li><a class="dropdown-item" href="../CRUD/logout.php">Sair</a></li>
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
                <h1 style="text-align: center; font-size: 3.5em;">
                    <span class="fs-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                        3ESSI - Scanner de Notas Fiscais
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                    </span>
                </h1>
                <hr>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="button" onclick="Exibir();">Selecionar</button>
                    <select class="form-select" id="inputGroupSelect03" aria-label="button addon">
                        <option selected>Escolha</option>
                        <option value="Aurora">Aurora - XML / Excel</option>
                        <option value="Cruzeiro">Cruzeiro - XML</option>
                        <option value="Suinco">Suinco - XML</option>
                        <option value="Plena">Plena - Excel</option>
                        <!-- <option value="5">Total</option> -->
                    </select>
                </div>
                <hr>
                <div class="Notas">
                    <div id="Aurora" class="hide container px-2 py-2 text-center">
                        <div class="row g-4 py-2 row-cols-1 row-cols-lg-2">
                            <div class="col">
                                <h2>Escanear XML Aurora</h2>
                                <form id="xmlForm">
                                    <div id="inserir" class="scan">
                                        <div class="mb-3">
                                            <input class="form-control" type="file" id="formFile" name="xmlFilesInput[]" accept=".xml" multiple required>
                                            <input id="dataAurora" class="form-control" type="date" style="margin-top: 5px;" required>
                                            <button type="button" id="scanButtonAurora" class='btns btn btn-outline-secondary'>Escanear &nbspXMLs</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-6 offset-md-3 mt-2">
                                    <div id="loadingAurora" class="hide">Carregando...</div>
                                    <progress id="progressBarAurora" class="hide" value="0" max="100"></progress>
                                </div>
                                <div id="outputAurora" class="mt-1"></div>
                            </div>
                            <div class="col">
                                <h2>Escanear Excel Aurora</h2>
                                <!-- enctype="multipart/form-data" action="uploadAurora.php" method="post" -->
                                <form id="xlsxFormAurora">
                                    <div class="mb-3">
                                        <input class="form-control" type="file" id="fileInput" name="excel_file" accept=".xlsx" required>
                                        <input type="submit" id="enviarAurora" class="btns btn btn-outline-secondary d-inline-block" value="Escanear XLSXs">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="Cruzeiro" class="hide container-fluid px-2 py-2 text-center">
                        <div class="hide row g-4 py-2 row-cols-1 row-cols-lg-1">
                            <div class="col">
                                    <h2>Escanear XML Cruzeiro</h2>
                                    <form id="xmlFormCruzeiro">
                                        <div id="inserir" class="scan">
                                            <div class="col-md-6 offset-md-3 mb-3">
                                                <input class="form-control" type="file" id="fileInput" name="xmlCruzeiroFilesInput[]" accept=".xml" multiple required>
                                                <input id="dataCruzeiro" type="date" class="form-control" required>
                                                <input id="cargaCruzeiro" type="number" class="form-control" placeholder="Digite a Carga:" required>
                                                <button type="button" id="scanButtonCruzeiro" class="btns btn btn-outline-secondary">Escanear XMLs</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="loadingCruzeiro" class="hide">Carregando...</div>
                                    <progress id="progressBarCruzeiro" class="hide" value="0" max="100"></progress>
                            </div>
                            <div id="outputCruzeiro"></div>
                        </div>
                    </div>
                    
                    <div id="Plena" class="hide container-fluid px-2 py-2 text-center">
                        <div class="hide row g-4 py-2 row-cols-1 row-cols-lg-1">
                            <div class="col">
                                <h2>Escanear Excel Plena</h2>
                                <form enctype="multipart/form-data" action="processPlena.php" method="post" id="plenaForm">
                                    <div id="inserir" class="scan">
                                        <div class="col-md-6 offset-md-3 mb-3">
                                            <input class="form-control" type="file" id="inputPlena" name="excel_file" accept=".xlsx" required>
                                            <input id="data" type="date" class="form-control" required/>
                                            <input id="cargaPlena" class="form-control" type="number" placeholder="Digite a Carga:" required>
                                            <input type="submit" value="Escanear XLSXs" class="btns btn btn-outline-secondary">
                                        </div>
                                    </div>
                                </form>
                                <!-- <div id="loadingPlena" style="display: none">Carregando...</div>
                                <progress id="progressBarPlena" value="0" max="100"></progress>
                                <div id="outputPlena"></div> -->
                            </div>
                            <div id="outputPlena"></div>
                        </div>
                    </div>

                    <div id="Suinco" class="hide container-fluid px-2 py-2 text-center">
                        <div class="hide row g-4 py-2 row-cols-1 row-cols-lg-1">
                            <div class="col">
                                <h2>Escanear XML Suinco</h2>
                                <form id="xmlFormSuinco">
                                    <div id="inserir" class="scan">
                                        <div class="col-md-6 offset-md-3 mb-3">
                                            <input class="form-control" type="file" id="InputSuinco" name="xmlSuincoFilesInput[]" accept=".xml" multiple required>
                                            <input id="dataSuinco" type="date" class="form-control" required>
                                            <input id="cargaSuinco" type="number" class="form-control" placeholder="Digite a Carga:" required>
                                            <button type="button" id="scanButtonSuinco" class="btns btn btn-outline-secondary">Escanear XMLs</button>
                                        </div>
                                    </div>
                                </form>
                                <div id="loadingSuinco" class="hide">Carregando...</div>
                                <progress id="progressBarSuinco" class="hide" value="0" max="100"></progress>
                                <div id="outputSuinco"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../_scriptjs/script.js"></script>
    <script src="../../_scriptjs/notas.js"></script>
</body>
</html>