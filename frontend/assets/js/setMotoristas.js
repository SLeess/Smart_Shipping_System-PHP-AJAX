$(document).ready(() => {
    $.ajax({
        url: '../app/api/endpoints/Usuario/GET_SessionUsuario.php',
        type: 'POST',
        data: {
            none: 0
        },
        success: (result) => {
            var resposta = JSON.parse(result);
            if(resposta.session == false){
                alert("Sessão inválida! Efetue login novamente");
                window.location.href = 'index.html';
            } else if(resposta.session.permissao != 1){
                alert("Acesso negado! Permissão de administrador necessária para acessar esse arquivo.");
                window.location.href = 'home.html';
            } else if(resposta.session == "desativado"){
                alert("Sessão inválida! Usuário desativado.");
                window.location.href = 'index.html';
            } else{
                gerarTituloPagina("Cadastro de Motoristas e Caminhões");
                gerarNavBar();
            }
        }
    });
   
    
    // Handle click event for the "Inserir Motorista-Caminhão" button
    $("#inserirMotorista").on("click", function () {
        var placa = $("#inputPlaca").val();
        var modelo = $("#inputModelo").val();
        var nome = $("#inputNome").val();
        var cpf = removerMascaraCPF($("#inputCPF").val());
        var habilitacao = $("#inputNumHabilitacao").val();
        var data = $("#inputData").val();
        var senha = $("#inputSenha").val();

        $.ajax({
            url: '../app/api/endpoints/Negocio/POST_MotoristasCaminhoes.php',
            type: 'POST',
            data: {
                inscricaoPlaca: placa,
                Modelo: modelo,
                inputNome: nome,
                inputCPF: cpf,
                inputNumHabilitacao: habilitacao,
                inputData: data,
                inputSenha: senha
            },
            success: (response) => {
                if (response.error) {
                    alert(response.error);
                } else {
                    alert(response.message);
                    window.location.href = 'setMotoristas.html';
                }
            }
        });
    });
});

function removerMascaraCPF(cpf) {
    var novo = cpf.replace(/[.-]/g, '');
    return novo;
}

function formatarCPF(input) {
    // Remove tudo que não é número
    var cpf = input.value.replace(/\D/g, "");

    // Limita o CPF a 11 dígitos
    if (cpf.length > 11) {
        cpf = cpf.slice(0, 11);
    }

    // Formata o CPF (XXX.XXX.XXX-XX)
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{2})$/, "$1-$2");
    }

    // Define o valor formatado de volta no campo
    input.value = cpf;
}