function verificaSenha(senha, confirmarSenha){
    if(senha == confirmarSenha && senha.length >= 8){
        $("#validadorDeSenha").addClass("hide");
    } else{
        $("#validadorDeSenha").removeClass("hide");
    }
}

function verificado(element, conteudo, tipo){
    //1 -> valido
    if(tipo == 1){
        if(conteudo != ''){
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


function sobre(element, op){
    if(op == 1){
        element.classList.add('active');
        element.classList.remove('text-black');     
    } else{
        element.classList.remove('active');
        element.classList.add('text-black');     
    }
}

function buscarUser(usuario){
    var validador = document.querySelector("#userValidation");
    $.ajax({
        type: "POST",
        url: "../app/api/endpoints/POST_ConsultaUsername.php",
        data: { usuario: usuario },
        success: response => {
            var resposta = JSON.parse(response).resposta;
            if(resposta === "false"){
                validador.classList.remove("hide");
                verificado(document.querySelector("#usuario"), "", 1);

            } else{
                validador.classList.add("hide");
                verificado(document.querySelector("#usuario"), usuario, 1);
            }
        }
    });
}

var nome;
var sobrenome;
var usuario;
var email;
var dominioEmail;
var senha;

function validarForm() {
    nome = document.getElementById("nome").value;
    sobrenome = document.getElementById("sobrenome").value;
    usuario = document.getElementById("usuario").value;
    email = document.getElementById("email").value;
    dominioEmail = document.getElementById("inputGroupSelection01").value;
    senha = document.getElementById("senha").value;
    var confirmSenha = document.getElementById("confirmarSenha").value;
    var checkboxMarcada = document.getElementById("gridCheck").checked;

    if (nome.length < 1 || sobrenome.length < 4 || usuario.length < 4 || email.length < 1 || senha.length < 8 || senha != confirmSenha || !checkboxMarcada || dominioEmail == "@domain.com") {
        return false;
    }
    if(senha.length < 8 || senha != confirmSenha){
        alert("Verique se a senha possui mais de 4 dígitos e se sua confirmação são iguais.");
        return false;
    }
    return true;
}

$(document).ready(() => {
    //-- Nome
    $(document).on('input', '#nome', function () {
        const nomeUsuario = $(this).val().replace(/[^A-Za-zÀ-ÖØ-öø-ÿ]+/g, '');
        $(this).val(nomeUsuario);
    });
    $(document).on('blur', '#nome', function () {
        verificado(document.getElementById("nome"), $(this).val(), 1);
    });

    //-- Sobrenome
    $(document).on('input', '#sobrenome', function () {
        const sobrenomeUsuario = $(this).val().replace(/[^A-Za-zÀ-ÖØ-öø-ÿ ]+/g, '');
        $(this).val(sobrenomeUsuario);
    });
    $(document).on('blur', '#sobrenome', function () {
        verificado(document.getElementById("sobrenome"), $(this).val(), 1);
    });

    //-- Usuário
    $(document).on('input', '#usuario', function () {
        const username = $(this).val().replace(/[^A-Za-z0-9._`´À-ÖØ-öø-ÿ ]+/g, '');
        $(this).val(username);
        var element = document.querySelector('#userValidation');
        element.classList.add('hide');
    });
    $(document).on('blur', '#usuario', function () {
        buscarUser($(this).val());
    });

    //-- Email
    $(document).on('input', '#email', function () {
        const email = $(this).val().replace(/[^a-zA-Z0-9]+/g, '');
        $(this).val(email);
    });
    $(document).on('blur', '#email', function () {
        verificado(document.getElementById("email"), $(this).val(), 1);
    });

    //-- senha
    $(document).on('input', '#senha', function () {
        const senha = $(this).val().replace(/[^a-zA-Z0-9]+/g, '');
        $(this).val(senha);
        verificado(document.querySelector('#passwordHelpBlock'), $(this).val(), 2);
    });
    $(document).on('blur', '#senha', function () {
        verificado(document.getElementById("senha"), $(this).val(), 1);
    });

    //--- VERIFICAÇÃO
    $(document).on('input', '.senhas', function (){
        verificaSenha($("#senha").val(), $("#confirmarSenha").val());
    });
    //---

    //-- confirmarsenha
    $(document).on('input', '#confirmarSenha', function () {
        const confirmarSenha = $(this).val().replace(/[^a-zA-Z0-9]+/g, '');
        $(this).val(confirmarSenha);
    });
    $(document).on('blur', '#confirmarSenha', function () {
        verificado(document.getElementById("confirmarSenha"), $(this).val(), 1);
    });

    $("#btnCadastrar").on('click', function () {
        if (validarForm()) {
            $.ajax({
                url: "../app/api/endpoints/POST_CadastrarUsuario.php",
                type: "POST",
                data: {
                    nome: nome,
                    sobrenome: sobrenome,
                    usuario: usuario,
                    email: email+dominioEmail,
                    senha: senha
                },
                success: response => {
                    var resposta = JSON.parse(response).resposta;
                    if(resposta == "false"){
                        alert("Erro no cadastro de usuário! Tente novamente");
                    } else{
                        alert("Cadastro realizado com sucesso!");
                        window.location.href = 'index.html';
                    }
                },
                error: function (error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });
        } else {
            alert("Por favor, preencha ou marque todos os campos corretamente.");
        }
    });
});