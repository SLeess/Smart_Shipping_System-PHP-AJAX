var usuario;
var email;
var nome;
var sobrenome;
var data;

document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: '../app/api/endpoints/Usuario/GET_SessionAllData.php',
        type: 'POST',
        data: {
            none: 0
        },
        success: (result) => {
            var resposta = JSON.parse(result);
            if(resposta.session == false){
                alert("Sessão inválida! Efetue login novamente.");
                window.location.href = 'index.html';
                return -1;
            } else if(resposta.session == "desativado"){
                alert("Sessão inválida! Usuário desativado.");
                window.location.href = 'index.html';
                return -1;
            } else{
                usuario = resposta.session.usuario;
                email = resposta.session.email;
                nome = resposta.session.nome;
                sobrenome = resposta.session.sobrenome;
                data = resposta.session.data;

                gerarTituloPagina("Alterar informações de Perfil");
                gerarNavBar();

                document.getElementById('spSession').innerHTML = usuario;
                document.getElementById('spEmail').innerHTML = email;
                $("#ipNome").val(nome);
                $("#ipSobrenome").val(sobrenome);
                $("#ipEmail").val(email);
                $("#ipData").val(data);
                $("#newUser").val(usuario);
            }
        }
    });
});

$(document).ready(() => {
    $("#newUser").on("blur", function(){
        buscarUser($(this).val());
    });

    $("#newUser").on("input", function(){
        $(this).val($(this).val().replace(/[^A-Za-z0-9._`´À-ÖØ-öø-ÿ ]+/g, ''));
        var element = document.querySelector('#userValidation'); 
        element.classList.add('hide');
    });

    $("#btnDesativar").on("click", function(){
        $.ajax({
            type: "POST",
            url: "../app/api/endpoints/Usuario/GET_DesativarConta.php",
            data: { none: 0 },
            success: (result) => {
                var Response = JSON.parse(result);
                if(Response.session == true){
                    alert("Conta desativada com sucesso!");
                    window.location.href = 'index.html';
                } else if(Response.session == "vazio"){
                    alert("Sessão inválida! Tente logar novamente no sistema.");
                    window.location.href = 'index.html';
                    return -1;
                } else{
                    alert("Erro no processo de desativação da conta.");
                }
            }
        });    
    });

    $("#btnSair").on("click", function(){
        //REQUISIÇÃO PARA SAIR DA CONTA
        $.ajax({
            type: "POST",
            url: "../app/api/endpoints/Usuario/GET_EndSession.php",
            data: { none: 0 },
            success: function() {
                window.location.href = 'index.html';
            }
        });
    });

    $("#btnSalvar").on("click", function(){
        //REQUISIÇÃO PARA SALVAR ALTERAÇÕES
        if($("#ipNome").val().length >= 1 && $("#ipSobrenome").val().length >= 3 && $("#ipEmail").val() >= 4 && $("#newUser").val().length >= 3)
            alterarDados();
        else{
            alert("Preencha todos os dados devidamente");
        }
    });
});

function buscarUser(usuario){
    $.ajax({
        type: "POST",
        url: "../app/api/endpoints/Usuario/POST_ConsultaUsername.php",
        data: { usuario: usuario },
        success: response => {
            var resposta = JSON.parse(response).resposta;
            if(resposta === "false"){
                $("#userValidation").removeClass("hide");
                verificado(document.querySelector("#newUser"), "", 1);

            } else{
                $("#userValidation").addClass("hide");
                verificado(document.querySelector("#newUser"), usuario, 1);
            }
        }
    });
}

function verificado(element, conteudo, tipo){
    //1 -> valido
    if(tipo == 1){
        if(conteudo != '' && conteudo.length >= 3){
            element.classList.add('is-valid');
            element.classList.remove('is-invalid');
        } else{
            element.classList.remove('is-valid');
            element.classList.add('is-invalid');
        }
    }

    //2 -> esconder
    if(tipo == 2){
        if(conteudo != ''){
            element.classList.add('hide');
        } else{
            element.classList.remove('hide');
        }
    }
}

function alterarDados(){
    $.ajax({
        type: "POST",
        url: "../app/api/endpoints/Usuario/GET_AlterarDadosConta.php",
        data: { 
            nome: $("#ipNome").val(),
            sobrenome: $("#ipSobrenome").val(),
            email: $("#ipEmail").val(),
            usuario: $("#newUser").val()
        },
        success: (result) => {
            console.log(result);
            var Response = JSON.parse(result);
            if(Response.session == "already"){
                alert("Erro! O nome de usuário desejado já está em uso");
            } else if(Response.session == "vazio"){
                alert("Sessão inválida! Tente logar novamente no sistema.");
                window.location.href = 'index.html';
                return -1;
            } else if(Response.session == true){
                alert("Dados alterados com sucesso!");
                window.location.href = 'perfilConfiguracoes.html';
            }
            else{
                alert("Erro no processo de alteração de dados da conta.");
            }
        }
    });
}