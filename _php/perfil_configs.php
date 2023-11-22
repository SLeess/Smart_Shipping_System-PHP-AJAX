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
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../_assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../_style/style.css">
    <style>
        input{
            margin-bottom: 10px;
        }

        .buttons{
            margin-top: -200px;
        }
    </style>
</head>
<body>
    <?php
        $relative = "";
        require_once("elements/navbar.php");
    ?>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="p-5 mb-3">
            <div class="dash col-lg-4 offset-lg-4 bg-white">
                <h2 style="text-align: center; font-size: 3.5em;">
                    <span class="fs-2">Sistema
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alt" viewBox="0 0 16 16">
                            <path d="M1 13.5a.5.5 0 0 0 .5.5h3.797a.5.5 0 0 0 .439-.26L11 3h3.5a.5.5 0 0 0 0-1h-3.797a.5.5 0 0 0-.439.26L5 13H1.5a.5.5 0 0 0-.5.5zm10 0a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5z"/>
                        </svg>
                    </span>
                </h2>
                <hr>
                
                <!-- mt-1: margin-top: 1em; mb-2: margin-bottom: 2em; -->
                <div class="container rounded bg-white mb-1">
                    <form action="CRUD/alterRow.php" method="POST">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-0">
                                    <!--<img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">-->
                                    <img src="https://cdn-icons-png.flaticon.com/256/6596/6596121.png" alt="" width="150px" class="rounded-circle mt-5">
                                    <span class="font-weight-bold">
                                        <?php
                                            echo $_SESSION['nome'];
                                        ?>
                                    </span>
                                    <span class="text-black-50">
                                        <?php
                                            echo $_SESSION["email"];
                                            $nome = ""; $sobrenome = "";
                                            $i = 0;
                                            for(;$i < strlen($_SESSION['nome']); $i++){
                                                if($_SESSION['nome'][$i] == " ") break;
                                                $nome .= $_SESSION['nome'][$i];
                                            }
                                            $i++;
                                            for(;$i < strlen($_SESSION['nome']); $i++){
                                                $sobrenome .= $_SESSION['nome'][$i];
                                            }
                                        ?>
                                    </span>
                                    <span>&nbsp;</span>
                                </div>
                            </div>
                            <div class="col-md-8 border-right">
                                <div class="p-3 py-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Configurações de Perfil</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Nome</label><input type="text" name="nome" required pattern="[A-Za-z ]+" class="form-control" placeholder="Primeiro nome" value="<?php echo $nome;?>"></div>
                                        <div class="col-md-6"><label class="labels">Sobrenome</label><input type="text" name="sobrenome" required pattern="[A-Za-z ]+" class="form-control" value="<?php echo $sobrenome;?>" placeholder="Sobrenome"></div>
                                        <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" required pattern=".*@.*\.com.*" class="form-control" placeholder="seuemail@dominio.com" value="<?php echo $_SESSION['email'];?>"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <!-- hide -->
                                            <small id="userValidation" class="hide" style="margin-top: 0; color: rgba(255, 0, 0, 0.678);">
                                                Usuário já cadastrado!
                                            </small>
                                            <br>
                                            <label class="labels">Nome de usuário</label>
                                            <input type="text" id="newUser" name="usuario" class="form-control" placeholder="Username" value="<?php echo $_SESSION['usuario'];?>" required pattern="[A-Za-z0-9._`´À-ÖØ-öø-ÿ ]+" onblur="buscarUser(this.value);" oninput="this.value = this.value.replace(/[^A-Za-z0-9._`´À-ÖØ-öø-ÿ ]+/, ''); var element = document.querySelector('#userValidation'); element.classList.add('hide');">
                                        </div>
                                        <div class="col-md-12"><label class="labels">Cep</label><input type="text" class="form-control" placeholder="Digite seu cep" value="" disabled></div>
                                        <div class="col-md-12"><label class="labels">Estado</label><input type="text" class="form-control" placeholder="Nome do estado" value="" disabled></div>
                                        <div class="col-md-12"><label class="labels">Bairro</label><input type="text" class="form-control" placeholder="Nome do bairro" value="" disabled></div>
                                        <div class="col-md-12"><label class="labels">Cidade</label><input type="text" class="form-control" placeholder="Nome da cidade" value="" disabled></div>
                                        <div class="col-md-12"><label class="labels">Referência</label><input type="text" class="form-control" placeholder="Referência" value="" disabled></div>
                                        <div class="col-md-12"><label class="labels">Escolaridade</label><input type="text" class="form-control" placeholder="Nível de Escolaridade" value="" disabled></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><label class="labels">País</label><input type="text" class="form-control" placeholder="Nome do país" value="" disabled></div>
                                        <div class="col-md-6"><label class="labels">Região</label><input type="text" class="form-control" value="" placeholder="Nome da região" disabled></div>
                                    </div>
                                    <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">Data de Cadastro</label><input type="text" class="form-control" value="<?php echo $_SESSION['data'];?>" placeholder="Nome da região" disabled></div>
                                    </div>
                                    <div class="buttons mt-5 text-center">
                                        <button class="btn btn-outline-primary profile-button" type="submit">Salvar alterações</button>
                                        <button class="btn btn-outline-danger profile-button" type="button" onclick="location.href='CRUD/deleteUser.php';">Apagar conta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../_scriptjs/script.js"></script>
    <script>
        function buscarUser(usuario){
            var validador = document.querySelector("#userValidation");
            $.ajax({
                type: "POST",
                url: "CRUD/consulta.php",
                data: { usuario: usuario },
                success: function(response) {
                    var resposta = response;
                    if(resposta === "false" && usuario != "<?php echo $_SESSION['usuario'];?>"){
                        validador.classList.remove("hide");
                        verificado(document.querySelector("#newUser"), "", 1);

                    } else{
                        validador.classList.add("hide");
                        verificado(document.querySelector("#newUser"), usuario, 1);
                    }
                }
            });
        }
    </script>
</body>
</html>