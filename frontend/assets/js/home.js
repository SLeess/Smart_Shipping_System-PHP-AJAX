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
                window.location.href = 'home.html';
            }
            gerarTituloPagina("Página Inicial");
            gerarNavBar(resposta.session.permissao, resposta.session.usuario);
        }
    });
});
