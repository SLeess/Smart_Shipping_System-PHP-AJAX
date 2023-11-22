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
            margin: 40px auto;
            max-width: 920px;
            min-height: 420px;
            min-width: 400px;
            max-height: 5200px;
            border-radius: 3px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
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
    <?php
        $relative = "";
        require_once("elements/navbar.php");
    ?>
    
    <div class="dash container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-white">
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